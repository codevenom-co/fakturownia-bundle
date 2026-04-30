<?php

namespace Codevenom\FakturowniaBundle\Report\Strategy;

use Codevenom\FakturowniaBundle\Invoice\Dto\InvoiceFilter;
use Codevenom\FakturowniaBundle\Report\Model\ReportInput;
use Codevenom\FakturowniaBundle\Report\Model\ReportOutput;
use Codevenom\FakturowniaBundle\Report\Service\ReportInvoicesService;

final class OverdueQueueReportGeneratorStrategy implements ReportGenerationStrategyInterface
{
    public function __construct(
        private ReportInvoicesService $reportInvoicesService
    ) {
    }

    public function getName(): string
    {
        return 'overdue_queue';
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

        $overdueInvoices = [];
        $totalOverdue = 0.0;
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
                $remaining = (float)$invoice->getPriceGross() - (float)$invoice->getPaid();
                $diff = $today->diff($dueDate)->days;
                
                $totalOverdue += $remaining;
                $overdueInvoices[] = [
                    'Invoice Number' => $invoice->getNumber(),
                    'Customer' => $invoice->getBuyerName(),
                    'Amount' => round($remaining, 2),
                    'Currency' => $invoice->getCurrency(),
                    'Days Overdue' => $diff,
                    'Due Date' => $dueDateStr,
                ];
            }
        }

        usort($overdueInvoices, fn($a, $b) => $b['Amount'] <=> $a['Amount']);

        $avgDaysOverdue = count($overdueInvoices) > 0 
            ? array_sum(array_column($overdueInvoices, 'Days Overdue')) / count($overdueInvoices) 
            : 0;

        return new ReportOutput(
            meta: [
                'report_name' => 'Overdue Queue (Collections Priority)',
                'generated_at' => date('c'),
                'data_freshness' => date('c'),
                'warnings' => [],
            ],
            definitions: [
                'basis' => 'payment_to (due date)',
                'metric_definitions' => [
                    'total_overdue' => 'Total amount of unpaid invoices past their due date',
                    'count_overdue' => 'Number of overdue invoices',
                    'avg_days_overdue' => 'Average delay in days for overdue invoices',
                ],
                'assumptions' => [
                    'Includes only income invoices not marked as paid.',
                    'Due date must be earlier than the report date.',
                ],
            ],
            kpis: [
                [
                    'name' => 'Total Overdue',
                    'value' => round($totalOverdue, 2),
                    'unit' => 'money',
                ],
                [
                    'name' => 'Count Overdue',
                    'value' => count($overdueInvoices),
                    'unit' => 'count',
                ],
                [
                    'name' => 'Avg Days Overdue',
                    'value' => round($avgDaysOverdue, 1),
                    'unit' => 'days',
                ],
            ],
            tables: [
                [
                    'name' => 'Top Overdue Invoices',
                    'columns' => ['Invoice Number', 'Customer', 'Amount', 'Currency', 'Days Overdue', 'Due Date'],
                    'rows' => array_slice($overdueInvoices, 0, 50),
                ]
            ],
            insights: [
                sprintf('Found %d overdue invoices.', count($overdueInvoices)),
                count($overdueInvoices) > 0 ? sprintf('Top debtor is %s with %s overdue.', $overdueInvoices[0]['Customer'], $overdueInvoices[0]['Amount']) : 'No overdue invoices found.',
            ]
        );
    }
}
