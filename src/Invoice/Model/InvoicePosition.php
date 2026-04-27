<?php

declare(strict_types=1);

namespace Codevenom\FakturowniaBundle\Invoice\Model;

use Symfony\Component\Serializer\Attribute\SerializedName;

final readonly class InvoicePosition
{
    public function __construct(
        private string $name,
        private int    $tax,
        #[SerializedName('total_price_gross')]
        private float  $totalPriceGross,
        private float  $quantity,
    )
    {
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getTax(): int
    {
        return $this->tax;
    }

    public function getTotalPriceGross(): float
    {
        return $this->totalPriceGross;
    }

    public function getQuantity(): float
    {
        return $this->quantity;
    }

}
