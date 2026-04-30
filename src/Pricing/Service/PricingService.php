<?php

namespace Codevenom\FakturowniaBundle\Pricing\Service;

use Codevenom\FakturowniaBundle\Client\FakturowniaPricingClientInterface;
use Codevenom\FakturowniaBundle\Pricing\Model\PriceList;

class PricingService
{
    public function __construct(
        private readonly FakturowniaPricingClientInterface $pricingClient,
    ) {
    }

    /**
     * @param array<string, mixed> $query
     * @return array<int, PriceList>
     */
    public function listPriceLists(array $query): array
    {
        return $this->pricingClient->listPriceLists($query);
    }

    public function findById(int $id): PriceList
    {
        return $this->pricingClient->findById($id);
    }

    public function create(PriceList $priceList): PriceList
    {
        return $this->pricingClient->create($priceList);
    }

    public function update(PriceList $priceList): PriceList
    {
        return $this->pricingClient->update($priceList);
    }

    public function deletePriceList(int $id): void
    {
        $this->pricingClient->deletePriceList($id);
    }
}
