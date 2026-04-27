<?php

namespace Codevenom\FakturowniaBundle\Invoice\MCP\FindInvoiceByNumber;

final readonly class FindInvoiceByNumberInput
{
    public function __construct(
        private string $number,
        private bool $income = true,
    )
    {
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