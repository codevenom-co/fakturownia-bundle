<?php

namespace Codevenom\FakturowniaBundle\Report\Strategy;

use Codevenom\FakturowniaBundle\Invoice\Dto\InvoiceFilter;
use Codevenom\FakturowniaBundle\Report\Model\ReportInput;
use Codevenom\FakturowniaBundle\Report\Model\ReportOutput;
use Codevenom\FakturowniaBundle\Report\Service\ReportInvoicesService;

final class ArAgingReportGeneratorStrategy implements ReportGenerationStrategyInterface
{
    public function __construct(
        private ReportInvoicesService $reportInvoicesService
    )
    {
    }

    public function getName(): string
    {
        return 'ar_aging';
    }

    public function supports(string $reportName): bool
    {
        return $reportName === $this->getName();
    }

    public function generate(ReportInput $input): ReportOutput
    {
        $filters = new InvoiceFilter(
            dateTo: $input->dateTo,
            income: 'yes',
        );

        $invoices = $this->reportInvoicesService->listInvoices($filters);

        $buckets = [
            'not_due' => 0.0,
            '1-30' => 0.0,
            '31-60' => 0.0,
            '61-90' => 0.0,
            '90+' => 0.0,
        ];
        $totalOverdue = 0.0;
        $count = 0;

        $today = new \DateTime();
        if ($input->dateTo) {
            $today = new \DateTime($input->dateTo);
        }

        foreach ($invoices as $invoice) {
            if ($invoice->isPaid() === true) {
                continue;
            }

            $count++;
            $remaining = (float)$invoice->getPriceGross() - (float)$invoice->getPaid();
            $dueDateStr = $invoice->getPaymentTo();

            if (!$dueDateStr) {
                $buckets['not_due'] += $remaining;
                continue;
            }

            $dueDate = new \DateTime($dueDateStr);
            if ($dueDate > $today) {
                $buckets['not_due'] += $remaining;
            } else {
                $diff = $today->diff($dueDate)->days;
                $totalOverdue += $remaining;

                if ($diff <= 30) {
                    $buckets['1-30'] += $remaining;
                } elseif ($diff <= 60) {
                    $buckets['31-60'] += $remaining;
                } elseif ($diff <= 90) {
                    $buckets['61-90'] += $remaining;
                } else {
                    $buckets['90+'] += $remaining;
                }
            }
        }

        return new ReportOutput(
            meta: [
                'report_name' => 'AR Aging & Overdue Risk',
                'generated_at' => date('c'),
                'data_freshness' => date('c'),
                'warnings' => [],
            ],
            definitions: [
                'basis' => 'payment_to (due date)',
                'metric_definitions' => [
                    'not_due' => 'Amount not yet due',
                    '1-30' => 'Amount overdue by 1-30 days',
                    '31-60' => 'Amount overdue by 31-60 days',
                    '61-90' => 'Amount overdue by 61-90 days',
                    '90+' => 'Amount overdue by more than 90 days',
                ],
                'assumptions' => [
                    'Includes only income invoices not marked as paid.',
                    'Calculated based on Price Gross minus Paid amount.',
                ],
            ],
            kpis: [
                [
                    'name' => 'Total Receivables',
                    'value' => round(array_sum($buckets), 2),
                    'unit' => 'money',
                ],
                [
                    'name' => 'Total Overdue',
                    'value' => round($totalOverdue, 2),
                    'unit' => 'money',
                ],
                [
                    'name' => 'Overdue Ratio',
                    'value' => array_sum($buckets) > 0 ? round(($totalOverdue / array_sum($buckets)) * 100, 2) : 0,
                    'unit' => 'percentage',
                ],
            ],
            tables: [
                [
                    'name' => 'Aging Buckets',
                    'columns' => ['Bucket', 'Amount'],
                    'rows' => [
                        ['Bucket' => 'Not yet due', 'Amount' => round($buckets['not_due'], 2)],
                        ['Bucket' => '1-30 days', 'Amount' => round($buckets['1-30'], 2)],
                        ['Bucket' => '31-60 days', 'Amount' => round($buckets['31-60'], 2)],
                        ['Bucket' => '61-90 days', 'Amount' => round($buckets['61-90'], 2)],
                        ['Bucket' => '90+ days', 'Amount' => round($buckets['90+'], 2)],
                    ],
                ]
            ],
            insights: [
                sprintf('Total of %d unpaid invoices found.', $count),
                $totalOverdue > 0 ? sprintf('%.2f is currently overdue.', $totalOverdue) : 'No overdue invoices found.',
            ]
        );
    }
}
