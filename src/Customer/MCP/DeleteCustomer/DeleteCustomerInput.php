<?php

namespace Codevenom\FakturowniaBundle\Customer\MCP\DeleteCustomer;

use Symfony\Component\Validator\Constraints as Assert;

final readonly class DeleteCustomerInput
{
    public function __construct(
        #[Assert\NotBlank(message: 'Customer ID is required.')]
        #[Assert\Type(type: 'integer', message: 'Customer ID must be an integer.')]
        private int $id,
    ) {
    }

    public function getId(): int
    {
        return $this->id;
    }
}
