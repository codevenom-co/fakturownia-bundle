<?php

namespace Codevenom\FakturowniaBundle\Invoice;

use Codevenom\FakturowniaBundle\Invoice\Enum\InvoicePeriod;
use Codevenom\FakturowniaBundle\Invoice\Model\CreateInvoice;
use Codevenom\FakturowniaBundle\Invoice\Model\Invoice;
use Codevenom\FakturowniaBundle\Invoice\Service\InvoiceService;
use Codevenom\FakturowniaBundle\Invoice\Dto\InvoiceFilter;

class InvoiceManager implements InvoiceManagerInterface
{

    public function __construct(
        private InvoiceService $invoiceService
    )
    {
    }

    /**
     * @param CreateInvoice $request
     * @return Invoice
     */
    public function createInvoice(CreateInvoice $request): Invoice
    {
        return $this->invoiceService->createInvoice($request);
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
        return $this->invoiceService->findByPeriod($period, $page, $perPage, $income);
    }

    /**
     * @param string $id
     * @return Invoice
     */
    public function findById(string $id): Invoice
    {
        return $this->invoiceService->findById($id);
    }

    public function findByNumber(string $number, bool $income = true): ?Invoice
    {
        return $this->invoiceService->findByNumber($number, $income);
    }

    public function listInvoices(InvoiceFilter $filters): iterable
    {
        return $this->invoiceService->listInvoices($filters);
    }
}