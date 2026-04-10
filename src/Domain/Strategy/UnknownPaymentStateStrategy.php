<?php

declare(strict_types=1);

namespace Codevenom\FakturowniaBundle\Domain\Strategy;

use Codevenom\FakturowniaBundle\Domain\Enum\PaymentState;

final class UnknownPaymentStateStrategy implements PaymentStateStrategyInterface
{
    public function supports(array $payload): bool
    {
        return true;
    }

    public function resolve(array $payload): PaymentState
    {
        return PaymentState::UNKNOWN;
    }
}
