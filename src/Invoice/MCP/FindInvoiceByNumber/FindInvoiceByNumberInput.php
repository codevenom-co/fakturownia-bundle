<?php

namespace Codevenom\FakturowniaBundle\Invoice\MCP\FindInvoiceByNumber;

use Symfony\Component\Validator\Constraints as Assert;

final readonly class FindInvoiceByNumberInput
{
    public function __construct(
        #[Assert\NotBlank(message: 'Invoice number must not be empty.')]
        private string $number,
        private bool $income = true,
    ) {
    }

    public function getNumber(): string
    {
        return $this->number;
    }

    public function isIncome(): bool
    {
        return $this->income;
    }
}
