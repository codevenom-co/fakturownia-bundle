<?php

namespace Codevenom\FakturowniaBundle\Invoice;

use Codevenom\FakturowniaBundle\Invoice\Model\CreateInvoice;
use Codevenom\FakturowniaBundle\Invoice\Model\Invoice;
use Codevenom\FakturowniaBundle\Invoice\Dto\InvoiceFilter;

final readonly class InvoiceApiModule implements InvoiceApiModuleInterface
{
    public function __construct(
        private InvoiceManagerInterface $invoiceManager,
    ) {
    }

    /**
     * @param InvoiceFilter $filters
     * @return iterable
     */
    public function listInvoices(InvoiceFilter $filters): iterable
    {
        return $this->invoiceManager->listInvoices($filters);
    }

    /**
     * @param CreateInvoice $request
     * @return Invoice
     */
    public function createInvoice(CreateInvoice $request): Invoice
    {
        return $this->invoiceManager->createInvoice($request);
    }
}
