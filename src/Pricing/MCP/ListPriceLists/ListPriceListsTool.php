<?php

namespace Codevenom\FakturowniaBundle\Pricing\MCP\ListPriceLists;

use Codevenom\FakturowniaBundle\Pricing\Mapper\PriceListPayloadMapper;
use Codevenom\FakturowniaBundle\Pricing\Model\PriceList;
use Codevenom\FakturowniaBundle\Pricing\PricingApiModuleInterface;
use Codevenom\FakturowniaBundle\Shared\MCP\McpToolExecutor;
use Codevenom\FakturowniaBundle\Shared\MCP\Response\McpResponder;
use Codevenom\FakturowniaBundle\Shared\MCP\Validation\McpInputValidator;
use Mcp\Capability\Attribute\McpTool;
use Symfony\Component\DependencyInjection\Attribute\AutoconfigureTag;

#[McpTool(
    name: 'codevenom.fakturownia.pricing.list',
    description: 'Lists all price lists from Fakturownia.'
)]
#[AutoconfigureTag('mcp.tool')]
final class ListPriceListsTool
{
    public function __construct(
        private PricingApiModuleInterface $pricingApiModule,
        private PriceListPayloadMapper    $priceListPayloadMapper,
        private McpResponder             $responder,
        private McpToolExecutor          $executor,
        private McpInputValidator        $inputValidator,
    ) {
    }

    /**
     * @param array<string, mixed> $query
     * @return array<string, mixed>
     */
    public function __invoke(array $query = []): array
    {
        return $this->executor->execute(function () use ($query): array {
            $input = new ListPriceListsInput();
            $input->query = $query;

            $this->inputValidator->validate($input);

            $priceLists = $this->pricingApiModule->listPriceLists($input->query ?? []);
            $payload = [];

            foreach ($priceLists as $priceList) {
                if ($priceList instanceof PriceList) {
                    $payload[] = $this->priceListPayloadMapper->toPayload($priceList);
                }
            }

            return $this->responder->success($payload);
        });
    }
}
