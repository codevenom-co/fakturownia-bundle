<?php

namespace Codevenom\FakturowniaBundle\Report\Strategy;

use Codevenom\FakturowniaBundle\Invoice\Dto\InvoiceFilter;
use Codevenom\FakturowniaBundle\Report\Model\ReportInput;
use Codevenom\FakturowniaBundle\Report\Model\ReportOutput;
use Codevenom\FakturowniaBundle\Report\Service\ReportInvoicesService;

final readonly class CashForecastReportGeneratorStrategy implements ReportGenerationStrategyInterface
{
    public function __construct(
        private ReportInvoicesService $reportInvoicesService
    ) {
    }

    public function getName(): string
    {
        return 'cash_forecast';
    }

    public function supports(string $reportName): bool
    {
        return $reportName === $this->getName();
    }

    public function generate(ReportInput $input): ReportOutput
    {
        $filters = new InvoiceFilter(
            income: 'yes',
        );

        $invoices = $this->reportInvoicesService->listInvoices($filters);

        $forecast = [];
        $totalForecast = 0.0;
        $today = new \DateTime($input->dateTo ?? 'now');

        foreach ($invoices as $invoice) {
            if ($invoice->isPaid()) {
                continue;
            }

            $dueDateStr = $invoice->getPaymentTo();
            if (!$dueDateStr) {
                continue;
            }

            $dueDate = new \DateTime($dueDateStr);
            if ($dueDate < $today) {
                $weekKey = 'Overdue';
            } else {
                $weekKey = 'W' . $dueDate->format('W') . ' (' . $dueDate->format('Y-m') . ')';
            }

            $remaining = (float)$invoice->getPriceGross() - (float)$invoice->getPaid();
            $totalForecast += $remaining;
            
            if (!isset($forecast[$weekKey])) {
                $forecast[$weekKey] = 0.0;
            }
            $forecast[$weekKey] += $remaining;
        }

        // Sort keys: Overdue first, then by week
        uksort($forecast, function($a, $b) {
            if ($a === 'Overdue') return -1;
            if ($b === 'Overdue') return 1;
            return strcmp($a, $b);
        });

        $rows = [];
        foreach ($forecast as $week => $amount) {
            $rows[] = ['Week' => $week, 'Expected Cash-in' => round($amount, 2)];
        }

        return new ReportOutput(
            meta: [
                'report_name' => 'Cash-In Forecast',
                'generated_at' => date('c'),
                'data_freshness' => date('c'),
                'warnings' => [],
            ],
            definitions: [
                'basis' => 'payment_to (due date)',
                'metric_definitions' => [
                    'total_expected' => 'Total expected cash-in from unpaid invoices',
                ],
                'assumptions' => [
                    'Bucketized by due week.',
                    'Overdue invoices are grouped in a single bucket.',
                ],
            ],
            kpis: [
                [
                    'name' => 'Total Forecasted Cash-in',
                    'value' => round($totalForecast, 2),
                    'unit' => 'money',
                ],
            ],
            tables: [
                [
                    'name' => 'Expected Cash-in by Week',
                    'columns' => ['Week', 'Expected Cash-in'],
                    'rows' => $rows,
                ]
            ],
            insights: [
                sprintf('Total forecasted cash-in is %s.', round($totalForecast, 2)),
                isset($forecast['Overdue']) ? sprintf('Warning: %s is already overdue.', round($forecast['Overdue'], 2)) : 'No overdue cash-in expected.',
            ]
        );
    }
}
