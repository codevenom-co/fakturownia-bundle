<?php

namespace Codevenom\FakturowniaBundle\Shared\Mapper;

use Symfony\Component\Serializer\Exception\ExceptionInterface;

interface PayloadMapperInterface
{
    /**
     * @return array<string, mixed>
     */
    public function toPayload(object $model): array;

    /**
     * @template T of object
     * @param array $data
     * @return object
     * @throws ExceptionInterface
     */
    public function toModel(array $data): object;
}