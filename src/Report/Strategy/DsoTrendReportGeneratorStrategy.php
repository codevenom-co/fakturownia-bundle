<?php

namespace Codevenom\FakturowniaBundle\Report\Strategy;

use Codevenom\FakturowniaBundle\Invoice\Dto\InvoiceFilter;
use Codevenom\FakturowniaBundle\Report\Model\ReportInput;
use Codevenom\FakturowniaBundle\Report\Model\ReportOutput;
use Codevenom\FakturowniaBundle\Report\Service\ReportInvoicesService;

final readonly class DsoTrendReportGeneratorStrategy implements ReportGenerationStrategyInterface
{
    public function __construct(
        private ReportInvoicesService $reportInvoicesService
    ) {
    }

    public function getName(): string
    {
        return 'dso_trend';
    }

    public function supports(string $reportName): bool
    {
        return $reportName === $this->getName();
    }

    public function generate(ReportInput $input): ReportOutput
    {
        $filters = new InvoiceFilter(
            dateFrom: $input->dateFrom ?? date('Y-m-d', strtotime('-12 months')),
            dateTo: $input->dateTo ?? date('Y-m-d'),
            income: 'yes',
        );

        $invoices = $this->reportInvoicesService->listInvoices($filters);

        $monthlyData = [];

        foreach ($invoices as $invoice) {
            $issueDateStr = $invoice->getIssueDate();
            if (!$issueDateStr) continue;

            $month = date('Y-m', strtotime($issueDateStr));
            if (!isset($monthlyData[$month])) {
                $monthlyData[$month] = [
                    'revenue' => 0.0,
                    'receivables' => 0.0,
                    'invoice_count' => 0,
                ];
            }

            $gross = (float)$invoice->getPriceGross();
            $paid = (float)$invoice->getPaid();
            $receivable = $gross - $paid;

            $monthlyData[$month]['revenue'] += $gross;
            $monthlyData[$month]['receivables'] += $receivable;
            $monthlyData[$month]['invoice_count']++;
        }

        ksort($monthlyData);

        $timeseriesPoints = [];
        foreach ($monthlyData as $month => $data) {
            $daysInMonth = (int)date('t', strtotime($month . '-01'));
            $dso = $data['revenue'] > 0 
                ? ($data['receivables'] / $data['revenue']) * $daysInMonth 
                : 0;

            $timeseriesPoints[] = [
                'period' => $month,
                'DSO' => round($dso, 1),
                'Revenue' => round($data['revenue'], 2),
                'Outstanding' => round($data['receivables'], 2),
            ];
        }

        $currentDso = !empty($timeseriesPoints) ? end($timeseriesPoints)['DSO'] : 0;

        return new ReportOutput(
            meta: [
                'report_name' => 'DSO Trend Analysis',
                'generated_at' => date('c'),
                'data_freshness' => date('c'),
                'warnings' => [],
            ],
            definitions: [
                'basis' => 'issue_date',
                'metric_definitions' => [
                    'DSO' => 'Days Sales Outstanding (Countback method): (Total Outstanding / Total Revenue) * Days in period',
                ],
                'assumptions' => [
                    'Includes all income invoices.',
                    'Calculated on a monthly basis.',
                ],
            ],
            kpis: [
                [
                    'name' => 'Current DSO',
                    'value' => $currentDso,
                    'unit' => 'days',
                ],
            ],
            timeseries: [
                [
                    'name' => 'DSO Trend',
                    'grain' => 'month',
                    'points' => $timeseriesPoints,
                ]
            ],
            insights: [
                sprintf('Current DSO is estimated at %.1f days.', $currentDso),
                'Stable DSO indicates healthy collection processes.'
            ]
        );
    }
}
