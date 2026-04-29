<?php

namespace Codevenom\FakturowniaBundle\Report\MCP\GetReport;

use Symfony\Component\Validator\Constraints as Assert;

final readonly class GetReportInput
{
    /**
     * @param array<string, mixed> $filters
     * @param string[] $groupBy
     */
    public function __construct(
        #[Assert\NotBlank(message: 'Report name must not be empty.')]
        private string $reportName,

        #[Assert\Date(message: 'Invalid date_from format. Use YYYY-MM-DD.')]
        private ?string $dateFrom = null,

        #[Assert\Date(message: 'Invalid date_to format. Use YYYY-MM-DD.')]
        private ?string $dateTo = null,

        #[Assert\Choice(choices: ['issue_date', 'paid_date', 'transaction_date'], message: 'Invalid basis.')]
        private ?string $basis = 'issue_date',

        private array $filters = [],

        private array $groupBy = [],

        private ?string $compareTo = null,
    ) {
    }

    public function getReportName(): string
    {
        return $this->reportName;
    }

    public function getDateFrom(): ?string
    {
        return $this->dateFrom;
    }

    public function getDateTo(): ?string
    {
        return $this->dateTo;
    }

    public function getBasis(): ?string
    {
        return $this->basis;
    }

    public function getFilters(): array
    {
        return $this->filters;
    }

    public function getGroupBy(): array
    {
        return $this->groupBy;
    }

    public function getCompareTo(): ?string
    {
        return $this->compareTo;
    }
}
