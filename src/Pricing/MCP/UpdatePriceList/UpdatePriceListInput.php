<?php

namespace Codevenom\FakturowniaBundle\Pricing\MCP\UpdatePriceList;

use Symfony\Component\Validator\Constraints as Assert;

class UpdatePriceListInput
{
    #[Assert\NotBlank]
    public readonly int $id;

    #[Assert\NotBlank]
    /** @var array<string, mixed> */
    public readonly array $priceList;

    /**
     * @param array<string, mixed> $priceList
     */
    public function __construct(int $id, array $priceList = [])
    {
        $this->id = $id;
        $this->priceList = $priceList;
    }
}
