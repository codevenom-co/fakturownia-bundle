<?php

declare(strict_types=1);

namespace Codevenom\FakturowniaBundle\Domain\Strategy;

use Codevenom\FakturowniaBundle\Domain\Enum\PaymentState;

final class ExplicitPaymentStateStrategy implements PaymentStateStrategyInterface
{
    public function supports(array $payload): bool
    {
        return PaymentState::UNKNOWN !== PaymentState::fromApiPayload($payload);
    }

    public function resolve(array $payload): PaymentState
    {
        return PaymentState::fromApiPayload($payload);
    }
}
