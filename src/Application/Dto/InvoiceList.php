<?php

declare(strict_types=1);

namespace Codevenom\FakturowniaBundle\Application\Dto;

use Codevenom\FakturowniaBundle\Domain\ValueObject\KeyValuePayload;

final readonly class InvoiceList
{
    public function __construct(
        public array $items,
        public KeyValuePayload $payload,
    ) {
    }

    public function toArray(): array
    {
        return $this->payload->toArray();
    }
}
