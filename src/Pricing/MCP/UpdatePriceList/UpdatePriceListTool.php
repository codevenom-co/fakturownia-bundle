<?php

namespace Codevenom\FakturowniaBundle\Pricing\MCP\UpdatePriceList;

use Codevenom\FakturowniaBundle\Pricing\Mapper\PriceListPayloadMapper;
use Codevenom\FakturowniaBundle\Pricing\Model\PriceList;
use Codevenom\FakturowniaBundle\Pricing\PricingApiModuleInterface;
use Codevenom\FakturowniaBundle\Shared\MCP\McpToolExecutor;
use Codevenom\FakturowniaBundle\Shared\MCP\Response\McpResponder;
use Codevenom\FakturowniaBundle\Shared\MCP\Utility\McpInputNormalizer;
use Codevenom\FakturowniaBundle\Shared\MCP\Validation\McpInputValidator;
use Mcp\Capability\Attribute\McpTool;
use Symfony\Component\DependencyInjection\Attribute\AutoconfigureTag;

#[McpTool(
    name: 'codevenom.fakturownia.pricing.update',
    description: 'Updates an existing price list in Fakturownia.'
)]
#[AutoconfigureTag('mcp.tool')]
final class UpdatePriceListTool
{
    public function __construct(
        private PricingApiModuleInterface $pricingApiModule,
        private PriceListPayloadMapper    $priceListPayloadMapper,
        private McpResponder             $responder,
        private McpToolExecutor          $executor,
        private McpInputValidator        $inputValidator,
        private McpInputNormalizer       $inputNormalizer,
    ) {
    }

    /**
     * @param array<string, mixed> $priceList
     * @return array<string, mixed>
     */
    public function __invoke(int $id, array $priceList = []): array
    {
        return $this->executor->execute(function () use ($id, $priceList): array {
            $priceList = $this->inputNormalizer->normalize($priceList);
            $input = new UpdatePriceListInput($id, $priceList);

            $this->inputValidator->validate($input);

            $priceListModel = $this->priceListPayloadMapper->toModel($input->priceList);
            $priceListModel->setId($input->id);

            $updatedPriceList = $this->pricingApiModule->update($priceListModel);

            return $this->responder->success($this->priceListPayloadMapper->toPayload($updatedPriceList));
        });
    }
}
