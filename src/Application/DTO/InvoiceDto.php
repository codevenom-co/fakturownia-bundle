<?php

declare(strict_types=1);

namespace Codevenom\FakturowniaBundle\Application\DTO;

use Codevenom\FakturowniaBundle\Domain\ValueObject\InvoiceId;
use Codevenom\FakturowniaBundle\Domain\ValueObject\KeyValuePayload;

final readonly class InvoiceDto
{
    public function __construct(
        public ?InvoiceId $id,
        public ?string $number,
        public ?string $currency,
        public KeyValuePayload $payload,
    ) {
    }

    public function toArray(): array
    {
        return $this->payload->toArray();
    }
}
