<?php

namespace Codevenom\FakturowniaBundle\Invoice\Mapper;

use Codevenom\FakturowniaBundle\Invoice\Model\CreateInvoice;
use Codevenom\FakturowniaBundle\Shared\Mapper\AbstractPayloadMapper;
use Codevenom\FakturowniaBundle\Shared\Mapper\PayloadMapperInterface;
use Symfony\Component\Serializer\SerializerInterface;

class CreateInvoicePayloadMapper extends AbstractPayloadMapper implements PayloadMapperInterface
{

    public function __construct(SerializerInterface $serializer)
    {
        parent::__construct($serializer);
    }

    public function toPayload(object $model): array
    {
        return [
            'invoice' => parent::convertToPayload($model),
        ];
    }

    public function toModel(array $data, ?object $objectToPopulate = null): object
    {
        return parent::convertToModel($data, CreateInvoice::class, $objectToPopulate);
    }
}