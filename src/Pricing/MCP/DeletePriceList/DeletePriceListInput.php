<?php

namespace Codevenom\FakturowniaBundle\Pricing\MCP\DeletePriceList;

use Symfony\Component\Validator\Constraints as Assert;

class DeletePriceListInput
{
    #[Assert\NotBlank]
    public int $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }
}
