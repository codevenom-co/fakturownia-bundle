<?php

declare(strict_types=1);

namespace Codevenom\FakturowniaBundle\Invoice\MCP\AddInvoice;

use Symfony\Component\Validator\Constraints as Assert;

final readonly class AddInvoiceInput
{
    public function __construct(
        #[Assert\Collection(
            fields: [
                'kind' => new Assert\Optional([new Assert\Type('string')]),
                'number' => new Assert\Optional([new Assert\Type('string')]),
                'sell_date' => new Assert\Optional([new Assert\Type('string'), new Assert\Date()]),
                'issue_date' => new Assert\Optional([new Assert\Type('string'), new Assert\Date()]),
                'payment_to' => new Assert\Optional([new Assert\Type('string'), new Assert\Date()]),
                'payment_to_kind' => new Assert\Optional([new Assert\Type('int')]),
                'seller_name' => new Assert\Optional([new Assert\Type('string')]),
                'seller_tax_no' => new Assert\Optional([new Assert\Type('string')]),
                'client_id' => new Assert\Optional([new Assert\Type('int')]),
                'buyer_name' => new Assert\Optional([new Assert\Type('string')]),
                'buyer_email' => new Assert\Optional([new Assert\Email()]),
                'buyer_tax_no' => new Assert\Optional([new Assert\Type('string')]),
                'buyer_post_code' => new Assert\Optional([new Assert\Type('string')]),
                'buyer_city' => new Assert\Optional([new Assert\Type('string')]),
                'buyer_street' => new Assert\Optional([new Assert\Type('string')]),
                'buyer_country' => new Assert\Optional([new Assert\Type('string')]),
                'buyer_override' => new Assert\Optional([new Assert\Type('bool')]),
                'copy_invoice_from' => new Assert\Optional([new Assert\Type('int')]),
                'advance_creation_mode' => new Assert\Optional([new Assert\Choice(['percent', 'amount'])]),
                'advance_value' => new Assert\Optional([new Assert\Type('string')]),
                'position_name' => new Assert\Optional([new Assert\Type('string')]),
                'invoice_ids' => new Assert\Optional([new Assert\All([new Assert\Type('int')])]),
                'positions' => new Assert\Required([
                    new Assert\Type('array'),
                    new Assert\Count(min: 1),
                    new Assert\All([
                        new Assert\Collection([
                            'name' => new Assert\Optional([new Assert\Type('string')]),
                            'tax' => new Assert\Optional([new Assert\Type('int')]),
                            'total_price_gross' => new Assert\Optional([new Assert\Type('numeric')]),
                            'quantity' => new Assert\Optional([new Assert\Type('numeric')]),
                            'product_id' => new Assert\Optional([new Assert\Type('int')]),
                        ])
                    ])
                ]),
            ],
            allowExtraFields: true
        )]
        private array $invoice
    ) {
    }

    public function getInvoice(): array
    {
        return $this->invoice;
    }
}
