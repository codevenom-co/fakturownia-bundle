<?php

namespace Codevenom\FakturowniaBundle\Pricing;

use Codevenom\FakturowniaBundle\Pricing\Model\PriceList;

interface PricingManagerInterface
{
    /**
     * @param array<string, mixed> $query
     * @return array<int, PriceList>
     */
    public function listPriceLists(array $query): array;

    public function findById(int $id): PriceList;

    public function create(PriceList $priceList): PriceList;

    public function update(PriceList $priceList): PriceList;

    public function deletePriceList(int $id): void;
}
