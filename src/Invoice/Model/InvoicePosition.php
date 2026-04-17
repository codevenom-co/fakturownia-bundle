<?php

declare(strict_types=1);

namespace Codevenom\FakturowniaBundle\Invoice\Model;

final readonly class InvoicePosition
{
    public function __construct(
        private string $name,
        private int $tax,
        private float $totalPriceGross,
        private float $quantity,
    ) {
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'tax' => !empty($this->tax) ? $this->tax : 'np',
            'total_price_gross' => $this->totalPriceGross,
            'quantity' => $this->quantity,
        ];
    }
}
