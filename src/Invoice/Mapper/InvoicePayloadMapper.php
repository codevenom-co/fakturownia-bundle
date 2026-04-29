<?php

namespace Codevenom\FakturowniaBundle\Invoice\Mapper;

use Codevenom\FakturowniaBundle\Invoice\Model\Invoice;
use Codevenom\FakturowniaBundle\Shared\Mapper\AbstractPayloadMapper;
use Codevenom\FakturowniaBundle\Shared\Mapper\PayloadMapperInterface;
use Symfony\Component\Serializer\SerializerInterface;

class InvoicePayloadMapper extends AbstractPayloadMapper implements PayloadMapperInterface
{

    public function __construct(SerializerInterface $serializer)
    {
        parent::__construct($serializer);
    }

    public function toPayload(object $model): array
    {
        return parent::convertToPayload($model);
    }


    public function toModel(array $data, ?object $objectToPopulate = null): object
    {
        return parent::convertToModel($data, Invoice::class, $objectToPopulate);
    }
}