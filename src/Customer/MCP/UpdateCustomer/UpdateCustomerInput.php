<?php

namespace Codevenom\FakturowniaBundle\Customer\MCP\UpdateCustomer;

use Symfony\Component\Validator\Constraints as Assert;

final readonly class UpdateCustomerInput
{
    /**
     * @param array<string, mixed> $client
     */
    public function __construct(
        #[Assert\NotBlank(message: 'Customer ID is required.')]
        #[Assert\Type(type: 'integer', message: 'Customer ID must be an integer.')]
        private int $id,

        #[Assert\NotBlank(message: 'Client data must not be empty.')]
        #[Assert\Collection(
            fields: [
                'name' => [new Assert\Optional()],
                'tax_no' => [new Assert\Optional()],
                'bank' => [new Assert\Optional()],
                'bank_account' => [new Assert\Optional()],
                'city' => [new Assert\Optional()],
                'country' => [new Assert\Optional()],
                'email' => [new Assert\Optional()],
                'person' => [new Assert\Optional()],
                'post_code' => [new Assert\Optional()],
                'phone' => [new Assert\Optional()],
                'street' => [new Assert\Optional()],
            ],
            allowExtraFields: false
        )]
        private array $client,
    ) {
    }

    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return array<string, mixed>
     */
    public function getClientData(): array
    {
        return $this->client;
    }
}
