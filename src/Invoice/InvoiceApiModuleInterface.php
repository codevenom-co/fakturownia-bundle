<?php

namespace Codevenom\FakturowniaBundle\Invoice;

use Codevenom\FakturowniaBundle\Invoice\Model\Invoice;
use Codevenom\FakturowniaBundle\Report\Dto\ReportsFilter;

interface InvoiceApiModuleInterface
{
    /**
     * @return iterable<Invoice>
     */
    public function listInvoices(ReportsFilter $filters): iterable;
}
