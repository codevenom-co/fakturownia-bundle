<?php

namespace Codevenom\FakturowniaBundle\Invoice\Model;

use Symfony\Component\Serializer\Attribute\SerializedName;

class CreateInvoice
{
    /**
     * @param array<InvoicePosition> $positions
     */
    public function __construct(
        private string  $kind = 'vat',
        private ?string $number = null,

        #[SerializedName('sell_date')]
        private ?string $sellDate = null,

        #[SerializedName('issue_date')]
        private ?string $issueDate = null,

        #[SerializedName('payment_to')]
        private ?string $paymentTo = null,

        #[SerializedName('payment_to_kind')]
        private ?int    $paymentToKind = null,

        #[SerializedName('department_id')]
        private ?int    $departmentId = null,

        #[SerializedName('seller_name')]
        private ?string $sellerName = null,

        #[SerializedName('seller_tax_no')]
        private ?string $sellerTaxNo = null,

        #[SerializedName('seller_country')]
        private ?string $sellerCountry = null,

        #[SerializedName('client_id')]
        private ?int    $clientId = null,

        #[SerializedName('buyer_override')]
        private ?bool   $buyerOverride = null,

        #[SerializedName('buyer_name')]
        private ?string $buyerName = null,

        #[SerializedName('buyer_email')]
        private ?string $buyerEmail = null,

        #[SerializedName('buyer_tax_no')]
        private ?string $buyerTaxNo = null,

        #[SerializedName('buyer_post_code')]
        private ?string $buyerPostCode = null,

        #[SerializedName('buyer_city')]
        private ?string $buyerCity = null,

        #[SerializedName('buyer_street')]
        private ?string $buyerStreet = null,

        #[SerializedName('buyer_country')]
        private ?string $buyerCountry = null,

        #[SerializedName('use_oss')]
        private ?bool   $useOss = null,

        #[SerializedName('income')]
        private ?string $income = null,

        #[SerializedName('copy_invoice_from')]
        private ?int    $copyInvoiceFrom = null,

        #[SerializedName('advance_creation_mode')]
        private ?string $advanceCreationMode = null,

        #[SerializedName('advance_value')]
        private ?string $advanceValue = null,

        #[SerializedName('position_name')]
        private ?string $positionName = null,

        #[SerializedName('invoice_ids')]
        private ?array  $invoiceIds = null,

        #[SerializedName('positions')]
        private array   $positions = [],
    )
    {
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

    public function getSellDate(): ?string
    {
        return $this->sellDate;
    }

    public function setSellDate(?string $sellDate): void
    {
        $this->sellDate = $sellDate;
    }

    public function getIssueDate(): ?string
    {
        return $this->issueDate;
    }

    public function setIssueDate(?string $issueDate): void
    {
        $this->issueDate = $issueDate;
    }

    public function getPaymentTo(): ?string
    {
        return $this->paymentTo;
    }

    public function setPaymentTo(?string $paymentTo): void
    {
        $this->paymentTo = $paymentTo;
    }

    public function getPaymentToKind(): ?int
    {
        return $this->paymentToKind;
    }

    public function setPaymentToKind(?int $paymentToKind): void
    {
        $this->paymentToKind = $paymentToKind;
    }

    public function getDepartmentId(): ?int
    {
        return $this->departmentId;
    }

    public function setDepartmentId(?int $departmentId): void
    {
        $this->departmentId = $departmentId;
    }

    public function getSellerName(): ?string
    {
        return $this->sellerName;
    }

    public function setSellerName(?string $sellerName): void
    {
        $this->sellerName = $sellerName;
    }

    public function getSellerTaxNo(): ?string
    {
        return $this->sellerTaxNo;
    }

    public function setSellerTaxNo(?string $sellerTaxNo): void
    {
        $this->sellerTaxNo = $sellerTaxNo;
    }

    public function getSellerCountry(): ?string
    {
        return $this->sellerCountry;
    }

    public function setSellerCountry(?string $sellerCountry): void
    {
        $this->sellerCountry = $sellerCountry;
    }

    public function getClientId(): ?int
    {
        return $this->clientId;
    }

    public function setClientId(?int $clientId): void
    {
        $this->clientId = $clientId;
    }

    public function getBuyerOverride(): ?bool
    {
        return $this->buyerOverride;
    }

    public function setBuyerOverride(?bool $buyerOverride): void
    {
        $this->buyerOverride = $buyerOverride;
    }

    public function getBuyerName(): ?string
    {
        return $this->buyerName;
    }

    public function setBuyerName(?string $buyerName): void
    {
        $this->buyerName = $buyerName;
    }

    public function getBuyerEmail(): ?string
    {
        return $this->buyerEmail;
    }

    public function setBuyerEmail(?string $buyerEmail): void
    {
        $this->buyerEmail = $buyerEmail;
    }

    public function getBuyerTaxNo(): ?string
    {
        return $this->buyerTaxNo;
    }

    public function setBuyerTaxNo(?string $buyerTaxNo): void
    {
        $this->buyerTaxNo = $buyerTaxNo;
    }

    public function getBuyerPostCode(): ?string
    {
        return $this->buyerPostCode;
    }

    public function setBuyerPostCode(?string $buyerPostCode): void
    {
        $this->buyerPostCode = $buyerPostCode;
    }

    public function getBuyerCity(): ?string
    {
        return $this->buyerCity;
    }

    public function setBuyerCity(?string $buyerCity): void
    {
        $this->buyerCity = $buyerCity;
    }

    public function getBuyerStreet(): ?string
    {
        return $this->buyerStreet;
    }

    public function setBuyerStreet(?string $buyerStreet): void
    {
        $this->buyerStreet = $buyerStreet;
    }

    public function getBuyerCountry(): ?string
    {
        return $this->buyerCountry;
    }

    public function setBuyerCountry(?string $buyerCountry): void
    {
        $this->buyerCountry = $buyerCountry;
    }

    public function getUseOss(): ?bool
    {
        return $this->useOss;
    }

    public function setUseOss(?bool $useOss): void
    {
        $this->useOss = $useOss;
    }

    public function getIncome(): ?string
    {
        return $this->income;
    }

    public function setIncome(?string $income): void
    {
        $this->income = $income;
    }

    public function getCopyInvoiceFrom(): ?int
    {
        return $this->copyInvoiceFrom;
    }

    public function setCopyInvoiceFrom(?int $copyInvoiceFrom): void
    {
        $this->copyInvoiceFrom = $copyInvoiceFrom;
    }

    public function getAdvanceCreationMode(): ?string
    {
        return $this->advanceCreationMode;
    }

    public function setAdvanceCreationMode(?string $advanceCreationMode): void
    {
        $this->advanceCreationMode = $advanceCreationMode;
    }

    public function getAdvanceValue(): ?string
    {
        return $this->advanceValue;
    }

    public function setAdvanceValue(?string $advanceValue): void
    {
        $this->advanceValue = $advanceValue;
    }

    public function getPositionName(): ?string
    {
        return $this->positionName;
    }

    public function setPositionName(?string $positionName): void
    {
        $this->positionName = $positionName;
    }

    /**
     * @return int[]|null
     */
    public function getInvoiceIds(): ?array
    {
        return $this->invoiceIds;
    }

    /**
     * @param int[]|null $invoiceIds
     */
    public function setInvoiceIds(?array $invoiceIds): void
    {
        $this->invoiceIds = $invoiceIds;
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