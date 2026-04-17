<?php

namespace Codevenom\FakturowniaBundle\Invoice\Model;

class CreateInvoice
{
    /**
     * @param array<InvoicePosition> $positions
     */
    public function __construct(
        private string $kind = 'vat',
        private ?string $number = null,
        private string $sellDate,
        private string $issueDate,
        private string $paymentTo,
        private string $sellerName,
        private string $sellerTaxNo,
        private string $buyerName,
        private string $buyerTaxNo,
        private string $buyerPostCode,
        private string $buyerCity,
        private string $buyerStreet,
        private array $positions,
    ) {
    }

    public function getKind(): string
    {
        return $this->kind;
    }

    public function setKind(string $kind): void
    {
        $this->kind = $kind;
    }

    public function getNumber(): ?string
    {
        return $this->number;
    }

    public function setNumber(?string $number): void
    {
        $this->number = $number;
    }

    public function getSellDate(): string
    {
        return $this->sellDate;
    }

    public function setSellDate(string $sellDate): void
    {
        $this->sellDate = $sellDate;
    }

    public function getIssueDate(): string
    {
        return $this->issueDate;
    }

    public function setIssueDate(string $issueDate): void
    {
        $this->issueDate = $issueDate;
    }

    public function getPaymentTo(): string
    {
        return $this->paymentTo;
    }

    public function setPaymentTo(string $paymentTo): void
    {
        $this->paymentTo = $paymentTo;
    }

    public function getSellerName(): string
    {
        return $this->sellerName;
    }

    public function setSellerName(string $sellerName): void
    {
        $this->sellerName = $sellerName;
    }

    public function getSellerTaxNo(): string
    {
        return $this->sellerTaxNo;
    }

    public function setSellerTaxNo(string $sellerTaxNo): void
    {
        $this->sellerTaxNo = $sellerTaxNo;
    }

    public function getBuyerName(): string
    {
        return $this->buyerName;
    }

    public function setBuyerName(string $buyerName): void
    {
        $this->buyerName = $buyerName;
    }

    public function getBuyerTaxNo(): string
    {
        return $this->buyerTaxNo;
    }

    public function setBuyerTaxNo(string $buyerTaxNo): void
    {
        $this->buyerTaxNo = $buyerTaxNo;
    }

    public function getBuyerPostCode(): string
    {
        return $this->buyerPostCode;
    }

    public function setBuyerPostCode(string $buyerPostCode): void
    {
        $this->buyerPostCode = $buyerPostCode;
    }

    public function getBuyerCity(): string
    {
        return $this->buyerCity;
    }

    public function setBuyerCity(string $buyerCity): void
    {
        $this->buyerCity = $buyerCity;
    }

    public function getBuyerStreet(): string
    {
        return $this->buyerStreet;
    }

    public function setBuyerStreet(string $buyerStreet): void
    {
        $this->buyerStreet = $buyerStreet;
    }

    public function getPositions(): array
    {
        return $this->positions;
    }

    public function setPositions(array $positions): void
    {
        $this->positions = $positions;
    }
}