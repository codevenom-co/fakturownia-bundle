<?php

namespace Codevenom\FakturowniaBundle\Pricing;

use Codevenom\FakturowniaBundle\Pricing\Model\PriceList;

class PricingApiModule implements PricingApiModuleInterface
{
    public function __construct(
        private readonly PricingManagerInterface $pricingManager,
    ) {
    }

    public function listPriceLists(array $query): array
    {
        return $this->pricingManager->listPriceLists($query);
    }

    public function findById(int $id): PriceList
    {
        return $this->pricingManager->findById($id);
    }

    public function create(PriceList $priceList): PriceList
    {
        return $this->pricingManager->create($priceList);
    }

    public function update(PriceList $priceList): PriceList
    {
        return $this->pricingManager->update($priceList);
    }

    public function deletePriceList(int $id): void
    {
        $this->pricingManager->deletePriceList($id);
    }
}
