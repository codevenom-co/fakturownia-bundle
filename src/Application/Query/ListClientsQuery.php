<?php

declare(strict_types=1);

namespace Codevenom\FakturowniaBundle\Application\Query;

use Codevenom\FakturowniaBundle\Domain\ValueObject\ClientId;

final readonly class ListClientsQuery
{
    public function __construct(
        public ?int $page = null,
        public ?int $perPage = null,
        public ?string $query = null,
        public ?ClientId $externalId = null,
    ) {
    }
}
