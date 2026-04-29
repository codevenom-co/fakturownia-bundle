<?php

namespace Codevenom\FakturowniaBundle\Report\Service;

use Codevenom\FakturowniaBundle\Invoice\InvoiceApiModuleInterface;
use Codevenom\FakturowniaBundle\Invoice\Model\Invoice;
use Codevenom\FakturowniaBundle\Report\Dto\ReportsFilter;

final readonly class ReportInvoicesService
{
    public function __construct(
        private InvoiceApiModuleInterface $invoiceApi,
    ) {
    }

    /**
     * @return iterable<Invoice>
     */
    public function listInvoices(ReportsFilter $filters): iterable
    {
        return $this->invoiceApi->listInvoices($filters);
    }
}
