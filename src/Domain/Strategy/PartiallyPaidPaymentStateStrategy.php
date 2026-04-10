<?php

declare(strict_types=1);

namespace Codevenom\FakturowniaBundle\Domain\Strategy;

use Codevenom\FakturowniaBundle\Domain\Enum\PaymentState;

final class PartiallyPaidPaymentStateStrategy implements PaymentStateStrategyInterface
{
    public function supports(array $payload): bool
    {
        $leftToPay = $this->toFloat($payload['left_to_pay'] ?? null);
        $totalGross = $this->toFloat($payload['price_gross'] ?? null);

        return null !== $leftToPay
            && null !== $totalGross
            && $leftToPay > 0.0
            && $leftToPay < $totalGross;
    }

    public function resolve(array $payload): PaymentState
    {
        return PaymentState::PARTIALLY_PAID;
    }

    private function toFloat(mixed $value): ?float
    {
        if (null === $value || '' === $value || !\is_numeric($value)) {
            return null;
        }

        return (float) $value;
    }
}
