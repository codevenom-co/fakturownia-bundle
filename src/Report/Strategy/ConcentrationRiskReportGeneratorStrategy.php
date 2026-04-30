<?php

namespace Codevenom\FakturowniaBundle\Report\Strategy;

use Codevenom\FakturowniaBundle\Invoice\Dto\InvoiceFilter;
use Codevenom\FakturowniaBundle\Report\Model\ReportInput;
use Codevenom\FakturowniaBundle\Report\Model\ReportOutput;
use Codevenom\FakturowniaBundle\Report\Service\ReportInvoicesService;

final readonly class ConcentrationRiskReportGeneratorStrategy implements ReportGenerationStrategyInterface
{
    public function __construct(
        private ReportInvoicesService $reportInvoicesService
    ) {
    }

    public function getName(): string
    {
        return 'concentration_risk';
    }

    public function supports(string $reportName): bool
    {
        return $reportName === $this->getName();
    }

    public function generate(ReportInput $input): ReportOutput
    {
        $filters = new InvoiceFilter(
            income: 'yes',
            dateFrom: $input->dateFrom,
            dateTo: $input->dateTo,
        );

        $invoices = $this->reportInvoicesService->listInvoices($filters);

        $customerRevenue = [];
        $totalRevenue = 0.0;

        foreach ($invoices as $invoice) {
            $clientId = $invoice->getClientId();
            $customerName = $invoice->getBuyerName();
            
            // Identity key policy: prefer client_id, fallback to name
            $key = $clientId ? (string)$clientId : ($customerName ?? 'Unknown');
            
            if (!isset($customerRevenue[$key])) {
                $customerRevenue[$key] = [
                    'name' => $customerName ?? 'Unknown',
                    'revenue' => 0.0,
                    'invoice_count' => 0,
                ];
            }

            $gross = (float)$invoice->getPriceGross();
            $customerRevenue[$key]['revenue'] += $gross;
            $customerRevenue[$key]['invoice_count']++;
            $totalRevenue += $gross;
        }

        uasort($customerRevenue, fn($a, $b) => $b['revenue'] <=> $a['revenue']);

        $rows = [];
        $top1Share = 0.0;
        $top3Share = 0.0;
        $top5Share = 0.0;
        $i = 0;

        foreach ($customerRevenue as $data) {
            $share = $totalRevenue > 0 ? ($data['revenue'] / $totalRevenue) * 100 : 0;
            if ($i < 10) {
                $rows[] = [
                    'Customer' => $data['name'],
                    'Revenue' => round($data['revenue'], 2),
                    'Share %' => round($share, 2),
                    'Invoices' => $data['invoice_count'],
                ];
            }

            if ($i < 1) $top1Share += $share;
            if ($i < 3) $top3Share += $share;
            if ($i < 5) $top5Share += $share;
            $i++;
        }

        return new ReportOutput(
            meta: [
                'report_name' => 'Revenue Concentration Risk',
                'generated_at' => date('c'),
                'data_freshness' => date('c'),
                'warnings' => [],
            ],
            definitions: [
                'basis' => 'issue_date',
                'metric_definitions' => [
                    'top1_share' => 'Percentage of total revenue from the largest customer',
                    'top3_share' => 'Percentage of total revenue from the top 3 customers',
                    'top5_share' => 'Percentage of total revenue from the top 5 customers',
                ],
                'assumptions' => [
                    'Includes all income invoices in the period.',
                ],
            ],
            kpis: [
                [
                    'name' => 'Top 1 Share',
                    'value' => round($top1Share, 2),
                    'unit' => 'percentage',
                ],
                [
                    'name' => 'Top 3 Share',
                    'value' => round($top3Share, 2),
                    'unit' => 'percentage',
                ],
                [
                    'name' => 'Top 5 Share',
                    'value' => round($top5Share, 2),
                    'unit' => 'percentage',
                ],
            ],
            tables: [
                [
                    'name' => 'Top Customers by Revenue',
                    'columns' => ['Customer', 'Revenue', 'Share %', 'Invoices'],
                    'rows' => $rows,
                ]
            ],
            insights: [
                sprintf('Top customer accounts for %.2f%% of total revenue.', $top1Share),
                $top3Share > 50 ? 'Warning: High revenue concentration in top 3 customers (>50%).' : 'Revenue concentration appears balanced.',
            ]
        );
    }
}
