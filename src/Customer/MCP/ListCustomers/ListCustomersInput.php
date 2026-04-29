<?php

namespace Codevenom\FakturowniaBundle\Customer\MCP\ListCustomers;

final readonly class ListCustomersInput
{
    /**
     * @param array<string, mixed> $query
     */
    public function __construct(
        private array $query = [],
    ) {
    }

    /**
     * @return array<string, mixed>
     */
    public function getQuery(): array
    {
        return $this->query;
    }
}
