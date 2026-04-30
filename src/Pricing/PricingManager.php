<?php

namespace Codevenom\FakturowniaBundle\Pricing;

use Codevenom\FakturowniaBundle\Pricing\Model\PriceList;
use Codevenom\FakturowniaBundle\Pricing\Service\PricingService;

class PricingManager implements PricingManagerInterface
{
    public function __construct(
        private readonly PricingService $pricingService,
    ) {
    }

    public function listPriceLists(array $query): array
    {
        return $this->pricingService->listPriceLists($query);
    }

    public function findById(int $id): PriceList
    {
        return $this->pricingService->findById($id);
    }

    public function create(PriceList $priceList): PriceList
    {
        return $this->pricingService->create($priceList);
    }

    public function update(PriceList $priceList): PriceList
    {
        return $this->pricingService->update($priceList);
    }

    public function deletePriceList(int $id): void
    {
        $this->pricingService->deletePriceList($id);
    }
}
