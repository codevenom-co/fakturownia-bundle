<?php

namespace Codevenom\FakturowniaBundle\Invoice\Model;

class CalculatingStrategy
{
    public function __construct(
        private ?string $position,
        private ?string $sum,
        private ?string $invoiceFormPriceKind,
    ) {
    }

    public function getPosition(): ?string
    {
        return $this->position;
    }

    public function setPosition(?string $position): void
    {
        $this->position = $position;
    }

    public function getSum(): ?string
    {
        return $this->sum;
    }

    public function setSum(?string $sum): void
    {
        $this->sum = $sum;
    }

    public function getInvoiceFormPriceKind(): ?string
    {
        return $this->invoiceFormPriceKind;
    }

    public function setInvoiceFormPriceKind(?string $invoiceFormPriceKind): void
    {
        $this->invoiceFormPriceKind = $invoiceFormPriceKind;
    }
}
