<?php

namespace Codevenom\FakturowniaBundle\Report\Strategy;

use Codevenom\FakturowniaBundle\Invoice\Dto\InvoiceFilter;
use Codevenom\FakturowniaBundle\Report\Model\ReportInput;
use Codevenom\FakturowniaBundle\Report\Model\ReportOutput;
use Codevenom\FakturowniaBundle\Report\Service\ReportInvoicesService;

final class HealthReportGeneratorStrategy implements ReportGenerationStrategyInterface
{
    public function __construct(
        private ReportInvoicesService $reportInvoicesService
    )
    {
    }

    public function getName(): string
    {
        return 'health';
    }

    public function supports(string $reportName): bool
    {
        return $reportName === $this->getName();
    }

    public function generate(ReportInput $input): ReportOutput
    {
        $filters = new InvoiceFilter(
            dateFrom: $input->dateFrom,
            dateTo: $input->dateTo,
            searchDateType: $input->basis,
        );

        $invoices = $this->reportInvoicesService->listInvoices($filters);

        $count = 0;
        $totalGross = 0.0;
        $currencies = [];

        foreach ($invoices as $invoice) {
            $count++;
            $totalGross += (float)$invoice->getPriceGross();
            $currency = $invoice->getCurrency();
            $currencies[$currency] = ($currencies[$currency] ?? 0) + 1;
        }

        return new ReportOutput(
            meta: [
                'report_name' => 'Health Report',
                'generated_at' => date('c'),
                'data_freshness' => date('c'),
                'warnings' => [],
            ],
            definitions: [
                'basis' => $input->basis ?? 'issue_date',
                'metric_definitions' => [
                    'invoice_count' => 'Total number of invoices in the period',
                    'total_gross' => 'Sum of gross prices of all invoices (raw sum, no currency conversion)',
                ],
                'assumptions' => [
                    'Includes all invoice kinds',
                ],
            ],
            kpis: [
                [
                    'name' => 'Invoice Count',
                    'value' => $count,
                    'unit' => 'count',
                ],
                [
                    'name' => 'Total Gross (Combined)',
                    'value' => round($totalGross, 2),
                    'unit' => 'money',
                    'explanation' => 'Simple sum of all gross amounts regardless of currency.',
                ],
            ],
            tables: [
                [
                    'name' => 'Invoices by Currency',
                    'columns' => ['Currency', 'Count'],
                    'rows' => array_map(fn($curr, $cnt) => ['Currency' => $curr, 'Count' => $cnt], array_keys($currencies), $currencies),
                ]
            ],
            insights: [
                sprintf('Found %d invoices in the requested period.', $count),
            ]
        );
    }
}
