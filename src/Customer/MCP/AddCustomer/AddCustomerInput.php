<?php

namespace Codevenom\FakturowniaBundle\Customer\MCP\AddCustomer;

use Symfony\Component\Validator\Constraints as Assert;

final readonly class AddCustomerInput
{
    /**
     * @param array<string, mixed> $client
     */
    public function __construct(
        #[Assert\NotBlank(message: 'Client data must not be empty.')]
        #[Assert\Collection(
            fields: [
                'name' => [new Assert\NotBlank(message: 'Customer name is required.')],
                'shortcut' => [new Assert\Optional()],
                'tax_no_kind' => [new Assert\Optional()],
                'tax_no' => [new Assert\Optional()],
                'register_number' => [new Assert\Optional()],
                'accounting_id' => [new Assert\Optional()],
                'post_code' => [new Assert\Optional()],
                'city' => [new Assert\Optional()],
                'street' => [new Assert\Optional()],
                'country' => [new Assert\Optional()],
                'use_delivery_address' => [new Assert\Optional()],
                'delivery_address' => [new Assert\Optional()],
                'first_name' => [new Assert\Optional()],
                'last_name' => [new Assert\Optional()],
                'email' => [new Assert\Optional()],
                'phone' => [new Assert\Optional()],
                'mobile_phone' => [new Assert\Optional()],
                'www' => [new Assert\Optional()],
                'fax' => [new Assert\Optional()],
                'note' => [new Assert\Optional()],
                'company' => [new Assert\Optional()],
                'kind' => [new Assert\Optional()],
                'category_id' => [new Assert\Optional()],
                'bank' => [new Assert\Optional()],
                'bank_account' => [new Assert\Optional()],
                'discount' => [new Assert\Optional()],
                'default_tax' => [new Assert\Optional()],
                'price_list_id' => [new Assert\Optional()],
                'payment_to_kind' => [new Assert\Optional()],
                'default_payment_type' => [new Assert\Optional()],
                'disable_auto_reminders' => [new Assert\Optional()],
                'person' => [new Assert\Optional()],
                'buyer_id' => [new Assert\Optional()],
                'mass_payment_code' => [new Assert\Optional()],
                'external_id' => [new Assert\Optional()],
            ],
            allowExtraFields: true
        )]
        private array $client,
    ) {
    }

    /**
     * @return array<string, mixed>
     */
    public function getClientData(): array
    {
        return $this->client;
    }
}
