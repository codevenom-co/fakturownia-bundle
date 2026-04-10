<?php

declare(strict_types=1);

namespace Codevenom\FakturowniaBundle\Domain\Enum;

enum PaymentState: string
{
    case PAID = 'paid';
    case PARTIALLY_PAID = 'partially_paid';
    case UNPAID = 'unpaid';
    case UNKNOWN = 'unknown';

    public static function fromApiPayload(array $payload): self
    {
        $value = $payload['payment_state'] ?? null;

        if (!\is_string($value) || '' === $value) {
            return self::UNKNOWN;
        }

        return self::tryFrom($value) ?? self::UNKNOWN;
    }
}
