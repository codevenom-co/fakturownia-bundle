<?php

declare(strict_types=1);

namespace Codevenom\FakturowniaBundle\Invoice\MCP\AddInvoice;

use Codevenom\FakturowniaBundle\Invoice\InvoiceApiModuleInterface;
use Codevenom\FakturowniaBundle\Invoice\Mapper\CreateInvoicePayloadMapper;
use Codevenom\FakturowniaBundle\Invoice\Model\CreateInvoice;
use Codevenom\FakturowniaBundle\Shared\MCP\McpToolExecutor;
use Codevenom\FakturowniaBundle\Shared\MCP\Response\McpResponder;
use Codevenom\FakturowniaBundle\Shared\MCP\Utility\McpInputNormalizer;
use Codevenom\FakturowniaBundle\Shared\MCP\Validation\McpInputValidator;
use Mcp\Capability\Attribute\McpTool;
use Symfony\Component\DependencyInjection\Attribute\AutoconfigureTag;

#[McpTool(
    name: 'codevenom.fakturownia.invoice.add',
    description: 'Create a new invoice in Fakturownia'
)]
#[AutoconfigureTag('mcp.tool')]
final readonly class AddInvoiceTool
{
    public function __construct(
        private InvoiceApiModuleInterface  $invoiceApiModule,
        private CreateInvoicePayloadMapper $createInvoicePayloadMapper,
        private McpInputValidator          $validator,
        private McpResponder               $responder,
        private McpToolExecutor            $executor,
    ) {
    }

    /**
     * @param array<string|int, mixed> $invoice
     * @return array<string, mixed>
     */
    public function __invoke(array $invoice): array
    {
        return $this->executor->execute(function () use ($invoice): array {
            $input = new AddInvoiceInput(McpInputNormalizer::normalize($invoice));
            $this->validator->validate($input);

            /** @var CreateInvoice $createInvoice */
            $createInvoice = $this->createInvoicePayloadMapper->toModel($input->getInvoice());

            $createdInvoice = $this->invoiceApiModule->createInvoice($createInvoice);

            return $this->responder->success($createdInvoice);
        });
    }
}
