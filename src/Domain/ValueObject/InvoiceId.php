<?php

declare(strict_types=1);

namespace Codevenom\FakturowniaBundle\Domain\ValueObject;

final readonly class InvoiceId
{
    public function __construct(public string $value)
    {
        if ('' === trim($this->value)) {
            throw new \InvalidArgumentException('InvoiceId cannot be empty.');
        }
    }

    public static function fromIntOrString(int|string $value): self
    {
        return new self((string) $value);
    }
}
