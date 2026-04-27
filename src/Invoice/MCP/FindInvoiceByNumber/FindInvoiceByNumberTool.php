<?php

namespace Codevenom\FakturowniaBundle\Invoice\MCP\FindInvoiceByNumber;

use Codevenom\FakturowniaBundle\Invoice\InvoiceManagerInterface;
use Mcp\Capability\Attribute\McpTool;
use Symfony\Component\DependencyInjection\Attribute\AsTaggedItem;

#[McpTool(
    name: 'codevenom.fakturownia.invoice.find_by_number',
    description: 'Finds an invoice by its number and returns key details (including due date/payment_to).'
)]
#[AsTaggedItem('mcp.tool')]
final class FindInvoiceByNumberTool
{
    public function __construct(
        private readonly InvoiceManagerInterface $invoiceManager,
    ) {}

    /**
     * The MCP bundle uses the invokable pattern for tools.
     *
     * @return array<string, mixed>
     */
    public function __invoke(FindInvoiceByNumberInput $input): array
    {
        $number = trim($input->getNumber());
        if ($number === '') {
            return [
                'ok' => false,
                'error' => [
                    'code' => 'invalid_arguments',
                    'message' => 'Invoice number must not be empty.',
                ],
            ];
        }

        $invoice = $this->invoiceManager->findByNumber($number, $input->isIncome());

        if (null === $invoice) {
            return [
                'ok' => false,
                'error' => [
                    'code' => 'not_found',
                    'message' => sprintf('Invoice "%s" not found.', $number),
                ],
            ];
        }

        return [
            'ok' => true,
            'invoice' => [
                'id' => $invoice->getId(),
                'number' => $invoice->getNumber(),
                'payment_to' => $invoice->getPaymentTo(),
                'issue_date' => $invoice->getIssueDate(),
                'buyer_name' => $invoice->getBuyerName(),
            ],
        ];
    }
}