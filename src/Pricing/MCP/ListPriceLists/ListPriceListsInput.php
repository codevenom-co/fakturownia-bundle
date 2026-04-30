<?php

namespace Codevenom\FakturowniaBundle\Pricing\MCP\ListPriceLists;

class ListPriceListsInput
{
    public function __construct(
        /** @var array<string, mixed>|null */
        private readonly ?array $query = []
    )
    {
    }

    public function getQuery(): ?array
    {
        return $this->query;
    }
}
