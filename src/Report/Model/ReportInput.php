<?php

namespace Codevenom\FakturowniaBundle\Report\Model;

use Symfony\Component\Validator\Constraints as Assert;

final class ReportInput
{
    /**
     * @param array<string, mixed> $filters
     * @param string[] $groupBy
     */
    public function __construct(
        #[Assert\NotBlank]
        public readonly string $reportName,

        #[Assert\Date]
        public readonly ?string $dateFrom = null,

        #[Assert\Date]
        public readonly ?string $dateTo = null,

        public readonly ?string $basis = 'issue_date',

        public readonly array $filters = [],

        public readonly array $groupBy = [],

        public readonly ?string $compareTo = null,
    ) {
    }
}
