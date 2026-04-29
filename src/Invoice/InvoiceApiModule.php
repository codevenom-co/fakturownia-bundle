<?php

namespace Codevenom\FakturowniaBundle\Invoice;

use Codevenom\FakturowniaBundle\Invoice\Model\Invoice;
use Codevenom\FakturowniaBundle\Report\Dto\ReportsFilter;

final readonly class InvoiceApiModule implements InvoiceApiModuleInterface
{
    public function __construct(
        private InvoiceManagerInterface $invoiceManager,
    ) {
    }

    public function listInvoices(ReportsFilter $filters): iterable
    {
        return $this->invoiceManager->listInvoices($filters);
    }
}
