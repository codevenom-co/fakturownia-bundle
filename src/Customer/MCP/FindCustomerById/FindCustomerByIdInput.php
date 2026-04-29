<?php

namespace Codevenom\FakturowniaBundle\Customer\MCP\FindCustomerById;

use Symfony\Component\Validator\Constraints as Assert;

final readonly class FindCustomerByIdInput
{
    public function __construct(
        #[Assert\NotBlank(message: 'Customer ID must not be empty.')]
        #[Assert\Type(type: 'integer', message: 'Customer ID must be an integer.')]
        private int $id,
    ) {
    }

    public function getId(): int
    {
        return $this->id;
    }
}
