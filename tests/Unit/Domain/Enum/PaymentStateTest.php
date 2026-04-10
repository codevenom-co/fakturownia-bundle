<?php

declare(strict_types=1);

namespace Codevenom\FakturowniaBundle\Tests\Unit\Domain\Enum;

use Codevenom\FakturowniaBundle\Domain\Enum\PaymentState;
use PHPUnit\Framework\TestCase;

final class PaymentStateTest extends TestCase
{
    public function testItMapsApiPayloadToPaid(): void
    {
        self::assertSame(PaymentState::PAID, PaymentState::fromApiPayload(['payment_state' => 'paid']));
    }

    public function testItMapsApiPayloadToPartiallyPaid(): void
    {
        self::assertSame(PaymentState::PARTIALLY_PAID, PaymentState::fromApiPayload(['payment_state' => 'partially_paid']));
    }

    public function testItMapsApiPayloadToUnpaid(): void
    {
        self::assertSame(PaymentState::UNPAID, PaymentState::fromApiPayload(['payment_state' => 'unpaid']));
    }

    public function testItFallsBackToUnknownForInvalidValue(): void
    {
        self::assertSame(PaymentState::UNKNOWN, PaymentState::fromApiPayload(['payment_state' => 'something_else']));
    }

    public function testItFallsBackToUnknownForMissingValue(): void
    {
        self::assertSame(PaymentState::UNKNOWN, PaymentState::fromApiPayload([]));
    }
}
