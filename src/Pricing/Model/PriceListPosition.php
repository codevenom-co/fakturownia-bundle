<?php

namespace Codevenom\FakturowniaBundle\Pricing\Model;

use Symfony\Component\Serializer\Annotation\SerializedName;

class PriceListPosition
{
    private ?int $id = null;

    #[SerializedName('priceable_id')]
    private ?int $priceableId = null;

    #[SerializedName('priceable_name')]
    private ?string $priceableName = null;

    #[SerializedName('priceable_type')]
    private ?string $priceableType = 'Product';

    #[SerializedName('use_percentage')]
    private ?bool $usePercentage = null;

    private ?string $percentage = null;

    #[SerializedName('price_net')]
    private ?string $priceNet = null;

    #[SerializedName('price_gross')]
    private ?string $priceGross = null;

    #[SerializedName('use_tax')]
    private ?bool $useTax = null;

    private ?string $tax = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getPriceableId(): ?int
    {
        return $this->priceableId;
    }

    public function setPriceableId(?int $priceableId): self
    {
        $this->priceableId = $priceableId;
        return $this;
    }

    public function getPriceableName(): ?string
    {
        return $this->priceableName;
    }

    public function setPriceableName(?string $priceableName): self
    {
        $this->priceableName = $priceableName;
        return $this;
    }

    public function getPriceableType(): ?string
    {
        return $this->priceableType;
    }

    public function setPriceableType(?string $priceableType): self
    {
        $this->priceableType = $priceableType;
        return $this;
    }

    public function isUsePercentage(): ?bool
    {
        return $this->usePercentage;
    }

    public function setUsePercentage(?bool $usePercentage): self
    {
        $this->usePercentage = $usePercentage;
        return $this;
    }

    public function getPercentage(): ?string
    {
        return $this->percentage;
    }

    public function setPercentage(?string $percentage): self
    {
        $this->percentage = $percentage;
        return $this;
    }

    public function getPriceNet(): ?string
    {
        return $this->priceNet;
    }

    public function setPriceNet(?string $priceNet): self
    {
        $this->priceNet = $priceNet;
        return $this;
    }

    public function getPriceGross(): ?string
    {
        return $this->priceGross;
    }

    public function setPriceGross(?string $priceGross): self
    {
        $this->priceGross = $priceGross;
        return $this;
    }

    public function isUseTax(): ?bool
    {
        return $this->useTax;
    }

    public function setUseTax(?bool $useTax): self
    {
        $this->useTax = $useTax;
        return $this;
    }

    public function getTax(): ?string
    {
        return $this->tax;
    }

    public function setTax(?string $tax): self
    {
        $this->tax = $tax;
        return $this;
    }
}
