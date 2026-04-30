<?php

namespace Codevenom\FakturowniaBundle\Invoice;

use Codevenom\FakturowniaBundle\Invoice\Model\CreateInvoice;
use Codevenom\FakturowniaBundle\Invoice\Model\Invoice;
use Codevenom\FakturowniaBundle\Invoice\Dto\InvoiceFilter;

interface InvoiceApiModuleInterface
{
    /**
     * @return iterable<Invoice>
     */
    public function listInvoices(InvoiceFilter $filters): iterable;

    /**
     * @param CreateInvoice $request
     * @return Invoice
     */
    public function createInvoice(CreateInvoice $request): Invoice;
}
