<?php

declare(strict_types=1);

namespace Codevenom\FakturowniaBundle\Domain\Strategy;

use Codevenom\FakturowniaBundle\Domain\Enum\PaymentState;

final class PaidPaymentStateStrategy implements PaymentStateStrategyInterface
{
    public function supports(array $payload): bool
    {
        $leftToPay = $this->toFloat($payload['left_to_pay'] ?? null);

        return true === ($payload['paid'] ?? null) || (null !== $leftToPay && $leftToPay <= 0.0);
    }

    public function resolve(array $payload): PaymentState
    {
        return PaymentState::PAID;
    }

    private function toFloat(mixed $value): ?float
    {
        if (null === $value || '' === $value || !\is_numeric($value)) {
            return null;
        }

        return (float) $value;
    }
}
