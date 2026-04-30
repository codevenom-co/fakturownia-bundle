<?php

namespace Codevenom\FakturowniaBundle\Report\Model;

use Symfony\Component\Validator\Constraints as Assert;

final readonly class ReportInput
{
    /**
     * @param array<string, mixed> $filters
     * @param string[] $groupBy
     */
    public function __construct(
        #[Assert\NotBlank]
        public string $reportName,

        #[Assert\Date]
        public ?string $dateFrom = null,

        #[Assert\Date]
        public ?string $dateTo = null,

        public ?string $basis = 'issue_date',

        public array $filters = [],

        public array $groupBy = [],

        public ?string $compareTo = null,
    ) {
    }
}
