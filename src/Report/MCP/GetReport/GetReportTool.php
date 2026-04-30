<?php

namespace Codevenom\FakturowniaBundle\Report\MCP\GetReport;

use Codevenom\FakturowniaBundle\Report\FakturowniaReportManagerInterface;
use Codevenom\FakturowniaBundle\Report\Model\ReportInput;
use Codevenom\FakturowniaBundle\Shared\MCP\McpToolExecutor;
use Codevenom\FakturowniaBundle\Shared\MCP\Response\McpResponder;
use Codevenom\FakturowniaBundle\Shared\MCP\Validation\McpInputValidator;
use Mcp\Capability\Attribute\McpTool;
use Symfony\Component\DependencyInjection\Attribute\AutoconfigureTag;

#[McpTool(
    name: 'codevenom.fakturownia.report.get',
    description: 'Generates a decision-ready report from Fakturownia data. Available reports: health, ar_aging, dso_trend, cash_forecast, etc.'
)]
#[AutoconfigureTag('mcp.tool')]
final class GetReportTool
{
    public function __construct(
        private FakturowniaReportManagerInterface $reportManager,
        private McpResponder $responder,
        private McpToolExecutor $executor,
        private McpInputValidator $inputValidator,
    ) {
    }

    /**
     * @param array<string, mixed> $filters
     * @param string[] $group_by
     */
    public function __invoke(
        string $report_name,
        ?string $date_from = null,
        ?string $date_to = null,
        ?string $basis = 'issue_date',
        array $filters = [],
        array $group_by = [],
        ?string $compare_to = null,
    ): array {
        return $this->executor->execute(function () use (
            $report_name,
            $date_from,
            $date_to,
            $basis,
            $filters,
            $group_by,
            $compare_to
        ): array {
            $input = new GetReportInput(
                reportName: $report_name,
                dateFrom: $date_from,
                dateTo: $date_to,
                basis: $basis,
                filters: $filters,
                groupBy: $group_by,
                compareTo: $compare_to
            );

            $this->inputValidator->validate($input);

            $reportOutput = $this->reportManager->generateReport(
                new ReportInput(
                    reportName: $input->getReportName(),
                    dateFrom: $input->getDateFrom(),
                    dateTo: $input->getDateTo(),
                    basis: $input->getBasis(),
                    filters: $input->getFilters(),
                    groupBy: $input->getGroupBy(),
                    compareTo: $input->getCompareTo()
                )
            );

            return $this->responder->success($reportOutput->toArray());
        });
    }
}
