<?php

namespace Codevenom\FakturowniaBundle\Invoice;

use Codevenom\FakturowniaBundle\Invoice\Model\Invoice;
use Codevenom\FakturowniaBundle\Invoice\Dto\InvoiceFilter;

interface InvoiceApiModuleInterface
{
    /**
     * @return iterable<Invoice>
     */
    public function listInvoices(InvoiceFilter $filters): iterable;
}
