<?php

namespace Codevenom\FakturowniaBundle\Shared\MCP\Serializer;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\SerializerInterface;

final class JsonAPIDeserializerManager
{
    public function __construct(
        private readonly SerializerInterface $serializer,
    ) {
    }

    public function Json(mixed $object, int $status = Response::HTTP_OK, array $groups = []): array
    {
        $context = [
            AbstractNormalizer::CIRCULAR_REFERENCE_HANDLER => function ($object, $format, $context) {
                if (method_exists($object, 'getId')) {
                    return $object->getId();
                }

                return null;
            },
            AbstractNormalizer::CIRCULAR_REFERENCE_LIMIT => 1,
        ];
        if (!empty($groups)) {
            $context['groups'] = $groups;
        }
        $json = $this->serializer->serialize($object, format: JsonEncoder::FORMAT, context: $context);

        return $this->serializer->decode($json, format: JsonEncoder::FORMAT);
    }

    public function throwException(\Throwable|\Exception $exception, int $status): array
    {
        $body = [
            'message' => $exception->getMessage(),
            'status' => $status,
        ];

        return $this->Json($body, $status);
    }
}
