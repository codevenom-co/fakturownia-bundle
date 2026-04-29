<?php

namespace Codevenom\FakturowniaBundle\Pricing\MCP\AddPriceList;

use Symfony\Component\Validator\Constraints as Assert;

class AddPriceListInput
{
    /**
     * @param array<string, mixed> $priceList
     */
    public function __construct(
        #[Assert\NotBlank]
        /** @var array<string, mixed> */
        private array $priceList = [],
    ) {
    }

    public function getPriceList(): array
    {
        return $this->priceList;
    }
}
