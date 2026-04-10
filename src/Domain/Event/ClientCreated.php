<?php

declare(strict_types=1);

namespace Codevenom\FakturowniaBundle\Domain\Event;

use Codevenom\FakturowniaBundle\Domain\ValueObject\KeyValuePayload;

final readonly class ClientCreated implements DomainEvent
{
    public function __construct(public KeyValuePayload $client)
    {
    }
}
