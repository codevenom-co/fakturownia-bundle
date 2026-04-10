<?php

declare(strict_types=1);

namespace Codevenom\FakturowniaBundle\Application\DTO;

use Codevenom\FakturowniaBundle\Domain\ValueObject\ClientId;
use Codevenom\FakturowniaBundle\Domain\ValueObject\KeyValuePayload;

final readonly class ClientDto
{
    public function __construct(
        public ?ClientId $id,
        public ?string $name,
        public KeyValuePayload $payload,
    ) {
    }

    public function toArray(): array
    {
        return $this->payload->toArray();
    }
}
