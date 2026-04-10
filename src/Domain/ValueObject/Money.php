<?php

declare(strict_types=1);

namespace Codevenom\FakturowniaBundle\Domain\ValueObject;

final readonly class Money
{
    public function __construct(
        public float $amount,
        public string $currency,
    ) {
        if ($this->amount < 0) {
            throw new \InvalidArgumentException('Money amount cannot be negative.');
        }

        if ('' === trim($this->currency)) {
            throw new \InvalidArgumentException('Money currency cannot be empty.');
        }
    }
}
