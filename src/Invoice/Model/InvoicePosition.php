<?php

declare(strict_types=1);

namespace Codevenom\FakturowniaBundle\Invoice\Model;

use Symfony\Component\Serializer\Attribute\SerializedName;

final readonly class InvoicePosition
{
    public function __construct(
        private ?string $name = null,
        private ?int    $tax = null,
        #[SerializedName('total_price_gross')]
        private ?float  $totalPriceGross = null,
        private float  $quantity = 1.0,
        #[SerializedName('product_id')]
        private ?int   $productId = null,
    )
    {
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getTax(): ?int
    {
        return $this->tax;
    }

    public function getTotalPriceGross(): ?float
    {
        return $this->totalPriceGross;
    }

    public function getQuantity(): float
    {
        return $this->quantity;
    }

    public function getProductId(): ?int
    {
        return $this->productId;
    }
}
