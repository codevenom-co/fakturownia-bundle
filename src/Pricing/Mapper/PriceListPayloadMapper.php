<?php

namespace Codevenom\FakturowniaBundle\Pricing\Mapper;

use Codevenom\FakturowniaBundle\Pricing\Model\PriceList;
use Codevenom\FakturowniaBundle\Shared\Mapper\AbstractPayloadMapper;
use Codevenom\FakturowniaBundle\Shared\Mapper\PayloadMapperInterface;

class PriceListPayloadMapper extends AbstractPayloadMapper implements PayloadMapperInterface
{
    public function toPayload(object $model): array
    {
        return $this->convertToPayload($model);
    }

    public function toModel(array $data, ?object $objectToPopulate = null, ?string $class = null): object
    {
        return $this->convertToModel($data, $class ?? $this->getModelClass(), $objectToPopulate);
    }

    protected function getModelClass(): string
    {
        return PriceList::class;
    }
}
