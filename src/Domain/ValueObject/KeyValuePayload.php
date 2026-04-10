<?php

declare(strict_types=1);

namespace Codevenom\FakturowniaBundle\Domain\ValueObject;

final readonly class KeyValuePayload
{
    public function __construct(private array $value)
    {
    }

    public static function fromArray(array $value): self
    {
        return new self($value);
    }

    public function toArray(): array
    {
        return $this->value;
    }
}
