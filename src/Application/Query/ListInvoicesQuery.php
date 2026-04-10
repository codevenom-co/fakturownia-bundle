<?php

declare(strict_types=1);

namespace Codevenom\FakturowniaBundle\Application\Query;

use Codevenom\FakturowniaBundle\Domain\ValueObject\ClientId;

final readonly class ListInvoicesQuery
{
    public function __construct(
        public ?int $page = null,
        public ?int $perPage = null,
        public ?string $period = null,
        public ?bool $includePositions = null,
        public ?ClientId $clientId = null,
        public ?string $number = null,
        public ?string $order = null,
        public ?string $income = null,
        public ?string $dateFrom = null,
        public ?string $dateTo = null,
        public ?string $searchDateType = null,
    ) {
    }
}
