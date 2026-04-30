<?php

namespace Codevenom\FakturowniaBundle\Invoice\MCP\FindInvoiceByNumber;

use Codevenom\FakturowniaBundle\Invoice\InvoiceManagerInterface;
use Codevenom\FakturowniaBundle\Invoice\Mapper\InvoicePayloadMapper;
use Codevenom\FakturowniaBundle\Shared\MCP\Exception\NotFoundException;
use Codevenom\FakturowniaBundle\Shared\MCP\McpToolExecutor;
use Codevenom\FakturowniaBundle\Shared\MCP\Response\McpResponder;
use Codevenom\FakturowniaBundle\Shared\MCP\Validation\McpInputValidator;
use Mcp\Capability\Attribute\McpTool;
use Symfony\Component\DependencyInjection\Attribute\AutoconfigureTag;

#[McpTool(
    name: 'codevenom.fakturownia.invoice.find_by_number',
    description: 'Finds an invoice by its number and returns key details (including due date/payment_to).'
)]
#[AutoconfigureTag('mcp.tool')]
final class FindInvoiceByNumberTool
{
    public function __construct(
        private readonly InvoiceManagerInterface $invoiceManager,
        private readonly InvoicePayloadMapper    $invoicePayloadMapper,
        private readonly McpResponder            $responder,
        private readonly McpToolExecutor         $executor,
        private readonly McpInputValidator       $inputValidator,
    )
    {
    }

    /**
     * @return array<string, mixed>
     */
    public function __invoke(string $number, bool $income = true): array
    {
        return $this->executor->execute(function () use ($number, $income): array {
            $input = new FindInvoiceByNumberInput($number, $income);

            $this->inputValidator->validate($input);

            $invoice = $this->invoiceManager->findByNumber(
                $input->getNumber(),
                $input->isIncome(),
            );

            if (null === $invoice) {
                throw new NotFoundException(sprintf('Invoice "%s" not found.', $input->getNumber()));
            }

            return $this->responder->success($this->invoicePayloadMapper->toPayload($invoice));
        });
    }
}