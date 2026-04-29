<?php

namespace Codevenom\FakturowniaBundle\Pricing\MCP\AddPriceList;

use Symfony\Component\Validator\Constraints as Assert;

class AddPriceListInput
{
    #[Assert\NotBlank]
    /** @var array<string, mixed> */
    public array $priceList;

    /**
     * @param array<string, mixed> $priceList
     */
    public function __construct(array $priceList = [])
    {
        $this->priceList = $priceList;
    }
}
