<?php

namespace Codevenom\FakturowniaBundle\Shared\Mapper;

use Symfony\Component\Serializer\Exception\ExceptionInterface;
use Symfony\Component\Serializer\Normalizer\AbstractObjectNormalizer;
use Symfony\Component\Serializer\SerializerInterface;

abstract class AbstractPayloadMapper
{
    public function __construct(
        private SerializerInterface $serializer,
    )
    {
    }

    /**
     * @param object $model
     * @return array
     */
    protected function convertToPayload(object $model): array
    {
        /** @var \Symfony\Component\Serializer\Normalizer\NormalizerInterface $serializer */
        $serializer = $this->serializer;
        return $serializer->normalize($model, 'json', [
            AbstractObjectNormalizer::SKIP_NULL_VALUES => true
        ]);
    }

    /**
     * @throws ExceptionInterface
     */
    protected function convertToModel(array $data, ?string $class = null, ?object $objectToPopulate = null): object
    {
        $json = json_encode($data);
        $context = [];
        if ($objectToPopulate) {
            $context[AbstractObjectNormalizer::OBJECT_TO_POPULATE] = $objectToPopulate;
        }

        return $this->serializer->deserialize($json, $class, 'json', $context);
    }
}