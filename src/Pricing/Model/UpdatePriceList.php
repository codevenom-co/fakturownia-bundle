<?php

namespace Codevenom\FakturowniaBundle\Pricing\Model;

use Symfony\Component\Serializer\Annotation\SerializedName;

class UpdatePriceList
{
    private ?string $name = null;

    private ?string $description = null;

    private ?string $currency = null;

    #[SerializedName('price_list_positions_attributes')]
    /** @var array<string, PriceListPosition>|null */
    private ?array $positions = null;

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;
        return $this;
    }

    public function getCurrency(): ?string
    {
        return $this->currency;
    }

    public function setCurrency(?string $currency): self
    {
        $this->currency = $currency;
        return $this;
    }

    /**
     * @return array<string, PriceListPosition>|null
     */
    public function getPositions(): ?array
    {
        return $this->positions;
    }

    /**
     * @param array<string, PriceListPosition>|null $positions
     */
    public function setPositions(?array $positions): self
    {
        $this->positions = $positions;
        return $this;
    }
}
