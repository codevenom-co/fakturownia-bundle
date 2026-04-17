<?php

namespace Codevenom\FakturowniaBundle\Invoice\Service;

use Codevenom\FakturowniaBundle\Client\FakturowniaClientInterface;
use Codevenom\FakturowniaBundle\Invoice\Enum\InvoicePeriod;
use Codevenom\FakturowniaBundle\Invoice\Model\CreateInvoice;
use Codevenom\FakturowniaBundle\Invoice\Model\Invoice;

readonly final class InvoiceService
{
    public function __construct(
        private readonly FakturowniaClientInterface $client
    )
    {
    }

    /**
     * @param CreateInvoice $request
     * @return Invoice
     */
    public function createInvoice(CreateInvoice $request): Invoice
    {
        return $this->client->createInvoice($request);
    }


    /**
     * @param InvoicePeriod $period
     * @param int $page
     * @param int $perPage
     * @param bool $income
     * @return array
     */
    public function findByPeriod(InvoicePeriod $period, int $page, int $perPage, bool $income = true): array
    {
        return $this->client->findByPeriod($period, $page, $perPage, $income);
    }

    /**
     * @param string $id
     * @return Invoice
     */
    public function findById(string $id): Invoice
    {
        return $this->client->findById($id);
    }
}