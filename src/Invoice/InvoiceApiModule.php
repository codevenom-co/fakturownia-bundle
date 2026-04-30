<?php

namespace Codevenom\FakturowniaBundle\Invoice;

use Codevenom\FakturowniaBundle\Invoice\Model\Invoice;
use Codevenom\FakturowniaBundle\Invoice\Dto\InvoiceFilter;

final readonly class InvoiceApiModule implements InvoiceApiModuleInterface
{
    public function __construct(
        private InvoiceManagerInterface $invoiceManager,
    ) {
    }

    public function listInvoices(InvoiceFilter $filters): iterable
    {
        return $this->invoiceManager->listInvoices($filters);
    }
}
