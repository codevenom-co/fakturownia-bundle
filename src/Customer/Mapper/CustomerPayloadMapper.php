<?php

namespace Codevenom\FakturowniaBundle\Customer\Mapper;

use Codevenom\FakturowniaBundle\Customer\Model\Customer;
use Codevenom\FakturowniaBundle\Customer\Model\UpdateCustomer;
use Codevenom\FakturowniaBundle\Shared\Mapper\AbstractPayloadMapper;
use Codevenom\FakturowniaBundle\Shared\Mapper\PayloadMapperInterface;
use Symfony\Component\Serializer\SerializerInterface;

class CustomerPayloadMapper extends AbstractPayloadMapper implements PayloadMapperInterface
{
    public function __construct(SerializerInterface $serializer)
    {
        parent::__construct($serializer);
    }

    public function toPayload(object $model): array
    {
        return parent::convertToPayload($model);
    }

    public function toModel(array $data, ?object $objectToPopulate = null, ?string $class = null): object
    {
        return parent::convertToModel($data, $class ?? Customer::class, $objectToPopulate);
    }
}
