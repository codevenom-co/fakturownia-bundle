<?php

declare(strict_types=1);

namespace Codevenom\FakturowniaBundle\Application\Command;

use Codevenom\FakturowniaBundle\Domain\ValueObject\KeyValuePayload;

final readonly class CreateClientCommand
{
    public function __construct(public KeyValuePayload $client)
    {
    }
}
