<?php

namespace Codevenom\FakturowniaBundle\Client;

use Codevenom\FakturowniaBundle\Invoice\Enum\InvoicePeriod;
use Codevenom\FakturowniaBundle\Invoice\Model\CreateInvoice;
use Codevenom\FakturowniaBundle\Invoice\Model\Invoice;

interface FakturowniaClientInterface
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

    /**
     * @param InvoicePeriod $period
     * @param int $page
     * @param int $perPage
     * @param bool $income
     * @return array
     */
    public function findByPeriod(InvoicePeriod $period, int $page, int $perPage, bool $income = true): array;

    /**
     * @param string $id
     * @return string
     */
    public function downloadInvoice(string $id): string;
}