<?php

namespace Codevenom\FakturowniaBundle\Invoice\Service;

use Codevenom\FakturowniaBundle\Client\FakturowniaClientInterface;
use Codevenom\FakturowniaBundle\Invoice\Enum\InvoicePeriod;
use Codevenom\FakturowniaBundle\Invoice\Model\CreateInvoice;
use Codevenom\FakturowniaBundle\Invoice\Model\Invoice;
use Codevenom\FakturowniaBundle\Report\Dto\ReportsFilter;

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

    public function findByNumber(string $number, bool $income = true): ?Invoice
    {
        return $this->client->findByNumber($number, $income);
    }

    public function listInvoices(ReportsFilter $filters): iterable
    {
        $page = 1;
        $perPage = 100;
        $maxPages = 100;

        $queryParams = array_merge($filters->toArray(), [
            'per_page' => $perPage,
        ]);

        if (isset($queryParams['date_from']) || isset($queryParams['date_to'])) {
            $queryParams['period'] = 'more';
        }

        while ($page <= $maxPages) {
            $queryParams['page'] = $page;
            $invoices = $this->client->listInvoices($queryParams);

            if (empty($invoices)) {
                break;
            }

            foreach ($invoices as $invoice) {
                yield $invoice;
            }

            if (count($invoices) < $perPage) {
                break;
            }

            $page++;
        }
    }
}