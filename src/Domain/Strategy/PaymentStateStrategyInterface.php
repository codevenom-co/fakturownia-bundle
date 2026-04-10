<?php

declare(strict_types=1);

namespace Codevenom\FakturowniaBundle\Domain\Strategy;

use Codevenom\FakturowniaBundle\Domain\Enum\PaymentState;

interface PaymentStateStrategyInterface
{
    public function supports(array $payload): bool;

    public function resolve(array $payload): PaymentState;
}
