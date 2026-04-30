<?php

namespace Codevenom\FakturowniaBundle\Pricing\MCP\DeletePriceList;

use Symfony\Component\Validator\Constraints as Assert;

final readonly class DeletePriceListInput
{

    public function __construct(
        #[Assert\NotBlank]
        private int $id
    )
    {
    }

    public function getId(): int
    {
        return $this->id;
    }
}
