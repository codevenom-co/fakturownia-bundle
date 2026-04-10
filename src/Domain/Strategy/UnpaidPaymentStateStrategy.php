<?php

declare(strict_types=1);

namespace Codevenom\FakturowniaBundle\Domain\Strategy;

use Codevenom\FakturowniaBundle\Domain\Enum\PaymentState;

final class UnpaidPaymentStateStrategy implements PaymentStateStrategyInterface
{
    public function supports(array $payload): bool
    {
        return null !== $this->toFloat($payload['left_to_pay'] ?? null);
    }

    public function resolve(array $payload): PaymentState
    {
        return PaymentState::UNPAID;
    }

    private function toFloat(mixed $value): ?float
    {
        if (null === $value || '' === $value || !\is_numeric($value)) {
            return null;
        }

        return (float) $value;
    }
}
