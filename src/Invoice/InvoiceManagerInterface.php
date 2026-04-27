<?php

namespace Codevenom\FakturowniaBundle\Invoice;

use Codevenom\FakturowniaBundle\Invoice\Model\CreateInvoice;
use Codevenom\FakturowniaBundle\Invoice\Model\Invoice;

interface InvoiceManagerInterface
{
    /**
     * @param CreateInvoice $request
     * @return Invoice
     */
    public function createInvoice(CreateInvoice $request): Invoice;

    /**
     * @param string $id
     * @return Invoice
     */
    public function findById(string $id): Invoice;


    /**
     * @param string $number
     * @param bool $income
     * @return Invoice|null
     */
    public function findByNumber(string $number, bool $income = true): ?Invoice;
}