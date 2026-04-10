<?php

declare(strict_types=1);

namespace Codevenom\FakturowniaBundle\Application\DTO;

use Codevenom\FakturowniaBundle\Domain\ValueObject\InvoiceId;
use Codevenom\FakturowniaBundle\Domain\ValueObject\KeyValuePayload;
use Codevenom\FakturowniaBundle\Domain\ValueObject\Money;

final readonly class PaymentStatusDto
{
    public function __construct(
        public ?InvoiceId $invoiceId,
        public ?string $invoiceNumber,
        public ?string $currency,
        public ?Money $totalGross,
        public ?Money $leftToPay,
        public ?bool $paidFlag,
        public ?string $paymentTo,
        public ?string $paidDate,
        public string $paymentState,
        public int $connectedPaymentsCount,
        public KeyValuePayload $payload,
    ) {
    }

    public function toArray(): array
    {
        return $this->payload->toArray();
    }
}
