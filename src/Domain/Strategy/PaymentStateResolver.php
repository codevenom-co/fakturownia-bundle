<?php

declare(strict_types=1);

namespace Codevenom\FakturowniaBundle\Domain\Strategy;

use Codevenom\FakturowniaBundle\Domain\Enum\PaymentState;

final class PaymentStateResolver
{
    private function strategies(): array
    {
        return [
            new ExplicitPaymentStateStrategy(),
            new PaidPaymentStateStrategy(),
            new PartiallyPaidPaymentStateStrategy(),
            new UnpaidPaymentStateStrategy(),
            new UnknownPaymentStateStrategy(),
        ];
    }

    public function resolve(array $payload): PaymentState
    {
        foreach ($this->strategies() as $strategy) {
            if ($strategy->supports($payload)) {
                return $strategy->resolve($payload);
            }
        }

        return PaymentState::UNKNOWN;
    }
}
