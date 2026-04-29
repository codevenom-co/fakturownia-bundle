<?php

namespace Codevenom\FakturowniaBundle\Pricing\MCP\DeletePriceList;

use Codevenom\FakturowniaBundle\Pricing\PricingApiModuleInterface;
use Codevenom\FakturowniaBundle\Shared\MCP\McpToolExecutor;
use Codevenom\FakturowniaBundle\Shared\MCP\Response\McpResponder;
use Codevenom\FakturowniaBundle\Shared\MCP\Validation\McpInputValidator;
use Mcp\Capability\Attribute\McpTool;
use Symfony\Component\DependencyInjection\Attribute\AutoconfigureTag;

#[McpTool(
    name: 'codevenom.fakturownia.pricing.delete',
    description: 'Deletes a price list from Fakturownia.'
)]
#[AutoconfigureTag('mcp.tool')]
final readonly class DeletePriceListTool
{
    public function __construct(
        private PricingApiModuleInterface $pricingApiModule,
        private McpResponder             $responder,
        private McpToolExecutor          $executor,
        private McpInputValidator        $inputValidator,
    ) {
    }

    public function __invoke(int $id): array
    {
        return $this->executor->execute(function () use ($id): array {
            $input = new DeletePriceListInput($id);

            $this->inputValidator->validate($input);

            $this->pricingApiModule->deletePriceList($input->getId());

            return $this->responder->success(['message' => sprintf('Price list with ID %d deleted successfully.', $id)]);
        });
    }
}
