<?php

declare(strict_types=1);

namespace Codevenom\FakturowniaBundle\Tests\Unit\Domain\Strategy;

use Codevenom\FakturowniaBundle\Domain\Enum\PaymentState;
use Codevenom\FakturowniaBundle\Domain\Strategy\PaymentStateResolver;
use PHPUnit\Framework\TestCase;

final class PaymentStateResolverTest extends TestCase
{
    private PaymentStateResolver $resolver;

    protected function setUp(): void
    {
        $this->resolver = new PaymentStateResolver();
    }

    public function testItResolvesPaidState(): void
    {
        self::assertSame(PaymentState::PAID, $this->resolver->resolve(['paid' => true]));
    }

    public function testItResolvesExplicitStateBeforeHeuristics(): void
    {
        self::assertSame(PaymentState::PARTIALLY_PAID, $this->resolver->resolve(['payment_state' => 'partially_paid']));
    }

    public function testItResolvesPartiallyPaidState(): void
    {
        self::assertSame(
            PaymentState::PARTIALLY_PAID,
            $this->resolver->resolve(['left_to_pay' => 50, 'price_gross' => 100])
        );
    }

    public function testItResolvesUnpaidState(): void
    {
        self::assertSame(PaymentState::UNPAID, $this->resolver->resolve(['left_to_pay' => 100]));
    }

    public function testItResolvesUnknownStateWhenDataIsIncomplete(): void
    {
        self::assertSame(PaymentState::UNKNOWN, $this->resolver->resolve([]));
    }
}
