<?php

declare(strict_types=1);

namespace Codevenom\FakturowniaBundle\Domain\Event;

use Codevenom\FakturowniaBundle\Domain\ValueObject\KeyValuePayload;

final readonly class InvoiceCreated implements DomainEvent
{
    public function __construct(public KeyValuePayload $invoice)
    {
    }
}
