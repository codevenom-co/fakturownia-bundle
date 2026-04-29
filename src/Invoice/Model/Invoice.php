<?php

namespace Codevenom\FakturowniaBundle\Invoice\Model;

use Codevenom\FakturowniaBundle\Invoice\Enum\InvoiceStatus;
use Symfony\Component\Serializer\Attribute\SerializedName;

;

class Invoice
{
    public function __construct(
        private ?int $id= null,
        #[SerializedName('user_id')]
        private ?int $userId= null,
        private mixed $app= null,
        private ?string $number= null,
        private mixed $place= null,
        #[SerializedName('sell_date')]
        private ?string $sellDate= null,
        #[SerializedName('payment_type')]
        private mixed $paymentType= null,
        #[SerializedName('price_net')]
        private ?string $priceNet= null,
        #[SerializedName('price_gross')]
        private ?string $priceGross= null,
        private ?string $currency= null,
        private ?string $status= null,
        private mixed $description= null,
        #[SerializedName('seller_name')]
        private ?string $sellerName= null,
        #[SerializedName('seller_tax_no')]
        private ?string $sellerTaxNo= null,
        #[SerializedName('seller_street')]
        private mixed $sellerStreet= null,
        #[SerializedName('seller_post_code')]
        private mixed $sellerPostCode= null,
        #[SerializedName('seller_city')]
        private mixed $sellerCity= null,
        #[SerializedName('seller_country')]
        private mixed $sellerCountry= null,
        #[SerializedName('seller_email')]
        private mixed $sellerEmail= null,
        #[SerializedName('seller_phone')]
        private mixed $sellerPhone= null,
        #[SerializedName('seller_fax')]
        private mixed $sellerFax= null,
        #[SerializedName('seller_www')]
        private mixed $sellerWww= null,
        #[SerializedName('seller_person')]
        private mixed $sellerPerson= null,
        #[SerializedName('seller_bank')]
        private mixed $sellerBank= null,
        #[SerializedName('seller_bank_account')]
        private ?string $sellerBankAccount= null,
        #[SerializedName('buyer_name')]
        private ?string $buyerName= null,
        #[SerializedName('buyer_tax_no')]
        private ?string $buyerTaxNo= null,
        #[SerializedName('buyer_post_code')]
        private mixed $buyerPostCode= null,
        #[SerializedName('buyer_city')]
        private mixed $buyerCity= null,
        #[SerializedName('buyer_street')]
        private mixed $buyerStreet= null,
        #[SerializedName('buyer_first_name')]
        private mixed $buyerFirstName= null,
        #[SerializedName('buyer_country')]
        private mixed $buyerCountry= null,
        #[SerializedName('created_at')]
        private ?string $createdAt= null,
        #[SerializedName('updated_at')]
        private ?string $updatedAt= null,
        private ?string $token= null,
        #[SerializedName('buyer_email')]
        private mixed $buyerEmail= null,
        #[SerializedName('buyer_www')]
        private mixed $buyerWww= null,
        #[SerializedName('buyer_fax')]
        private mixed $buyerFax= null,
        #[SerializedName('buyer_phone')]
        private mixed $buyerPhone= null,
        private ?string $kind= null,
        private ?string $pattern= null,
        #[SerializedName('pattern_nr')]
        private mixed $patternNr= null,
        #[SerializedName('pattern_nr_m')]
        private ?int $patternNrM= null,
        #[SerializedName('pattern_nr_d')]
        private mixed $patternNrD= null,
        #[SerializedName('client_id')]
        private ?int $clientId= null,
        #[SerializedName('payment_to')]
        private ?string $paymentTo= null,
        private ?string $paid= null,
        #[SerializedName('seller_bank_account_id')]
        private mixed $sellerBankAccountId= null,
        private ?string $lang= null,
        #[SerializedName('issue_date')]
        private ?string $issueDate= null,
        #[SerializedName('price_tax')]
        private ?string $priceTax= null,
        #[SerializedName('department_id')]
        private ?int $departmentId= null,
        private mixed $correction= null,
        #[SerializedName('buyer_note')]
        private mixed $buyerNote= null,
        #[SerializedName('additional_info_desc')]
        private mixed $additionalInfoDesc= null,
        #[SerializedName('additional_info')]
        private ?bool $additionalInfo= null,
        #[SerializedName('product_cache')]
        private ?string $productCache= null,
        #[SerializedName('buyer_last_name')]
        private mixed $buyerLastName= null,
        #[SerializedName('from_invoice_id')]
        private mixed $fromInvoiceId= null,
        private mixed $oid= null,
        private ?string $discount= null,
        #[SerializedName('show_discount')]
        private ?bool $showDiscount= null,
        #[SerializedName('sent_time')]
        private mixed $sentTime= null,
        #[SerializedName('print_time')]
        private mixed $printTime= null,
        #[SerializedName('recurring_id')]
        private mixed $recurringId= null,
        #[SerializedName('tax2_visible')]
        private mixed $tax2Visible= null,
        #[SerializedName('warehouse_id')]
        private mixed $warehouseId= null,
        #[SerializedName('paid_date')]
        private mixed $paidDate= null,
        #[SerializedName('product_id')]
        private ?int $productId= null,
        #[SerializedName('issue_year')]
        private ?int $issueYear= null,
        #[SerializedName('internal_note')]
        private mixed $internalNote= null,
        #[SerializedName('invoice_id')]
        private mixed $invoiceId= null,
        #[SerializedName('invoice_template_id')]
        private ?int $invoiceTemplateId= null,
        #[SerializedName('description_long')]
        private mixed $descriptionLong= null,
        #[SerializedName('buyer_tax_no_kind')]
        private mixed $buyerTaxNoKind= null,
        #[SerializedName('seller_tax_no_kind')]
        private mixed $sellerTaxNoKind= null,
        #[SerializedName('description_footer')]
        private mixed $descriptionFooter= null,
        #[SerializedName('sell_date_kind')]
        private mixed $sellDateKind= null,
        #[SerializedName('payment_to_kind')]
        private ?string $paymentToKind= null,
        #[SerializedName('exchange_currency')]
        private mixed $exchangeCurrency= null,
        #[SerializedName('discount_kind')]
        private ?string $discountKind= null,
        private ?bool $income= null,
        #[SerializedName('from_api')]
        private ?bool $fromApi= null,
        #[SerializedName('category_id')]
        private mixed $categoryId= null,
        #[SerializedName('warehouse_document_id')]
        private mixed $warehouseDocumentId= null,
        #[SerializedName('exchange_kind')]
        private ?string $exchangeKind= null,
        #[SerializedName('exchange_rate')]
        private ?string $exchangeRate= null,
        #[SerializedName('use_delivery_address')]
        private ?bool $useDeliveryAddress= null,
        #[SerializedName('delivery_address')]
        private mixed $deliveryAddress= null,
        #[SerializedName('accounting_kind')]
        private mixed $accountingKind= null,
        #[SerializedName('buyer_person')]
        private ?string $buyerPerson= null,
        #[SerializedName('buyer_bank_account')]
        private mixed $buyerBankAccount= null,
        #[SerializedName('buyer_bank')]
        private mixed $buyerBank= null,
        #[SerializedName('buyer_mass_payment_code')]
        private mixed $buyerMassPaymentCode= null,
        #[SerializedName('exchange_note')]
        private ?string $exchangeNote= null,
        #[SerializedName('buyer_company')]
        private ?bool $buyerCompany= null,
        #[SerializedName('show_attachments')]
        private ?bool $showAttachments= null,
        #[SerializedName('exchange_currency_rate')]
        private mixed $exchangeCurrencyRate= null,
        #[SerializedName('has_attachments')]
        private ?bool $hasAttachments= null,
        #[SerializedName('exchange_date')]
        private mixed $exchangeDate= null,
        #[SerializedName('attachments_count')]
        private ?int $attachmentsCount= null,
        #[SerializedName('delivery_date')]
        private ?string $deliveryDate= null,
        #[SerializedName('fiscal_status')]
        private mixed $fiscalStatus= null,
        #[SerializedName('use_moss')]
        private ?bool $useMoss= null,
        #[SerializedName('calculating_strategy')]
        private ?array $calculatingStrategy= null,
        #[SerializedName('transaction_date')]
        private ?string $transactionDate= null,
        #[SerializedName('email_status')]
        private mixed $emailStatus= null,
        #[SerializedName('exclude_from_stock_level')]
        private ?bool $excludeFromStockLevel= null,
        #[SerializedName('exclude_from_accounting')]
        private ?bool $excludeFromAccounting= null,
        #[SerializedName('exchange_rate_den')]
        private ?string $exchangeRateDen= null,
        #[SerializedName('exchange_currency_rate_den')]
        private ?string $exchangeCurrencyRateDen= null,
        #[SerializedName('accounting_scheme')]
        private mixed $accountingScheme= null,
        #[SerializedName('exchange_difference')]
        private ?string $exchangeDifference= null,
        #[SerializedName('not_cost')]
        private ?bool $notCost= null,
        #[SerializedName('reverse_charge')]
        private ?bool $reverseCharge= null,
        private mixed $issuer= null,
        #[SerializedName('use_issuer')]
        private ?bool $useIssuer= null,
        private ?bool $cancelled= null,
        #[SerializedName('recipient_id')]
        private mixed $recipientId= null,
        #[SerializedName('recipient_name')]
        private ?string $recipientName= null,
        private ?bool $test= null,
        #[SerializedName('discount_net')]
        private ?string $discountNet= null,
        #[SerializedName('approval_status')]
        private mixed $approvalStatus= null,
        #[SerializedName('accounting_vat_tax_date')]
        private ?string $accountingVatTaxDate= null,
        #[SerializedName('accounting_income_tax_date')]
        private ?string $accountingIncomeTaxDate= null,
        #[SerializedName('accounting_other_tax_date')]
        private mixed $accountingOtherTaxDate= null,
        #[SerializedName('accounting_status')]
        private mixed $accountingStatus= null,
        #[SerializedName('normalized_number')]
        private mixed $normalizedNumber= null,
        #[SerializedName('na_tax_kind')]
        private mixed $naTaxKind= null,
        #[SerializedName('issued_to_receipt')]
        private ?bool $issuedToReceipt= null,
        #[SerializedName('gov_id')]
        private mixed $govId= null,
        #[SerializedName('gov_kind')]
        private mixed $govKind= null,
        #[SerializedName('gov_status')]
        private mixed $govStatus= null,
        #[SerializedName('sales_code')]
        private ?string $salesCode= null,
        #[SerializedName('additional_invoice_field')]
        private mixed $additionalInvoiceField= null,
        #[SerializedName('products_margin')]
        private mixed $productsMargin= null,
        #[SerializedName('payment_url')]
        private ?string $paymentUrl= null,
        #[SerializedName('view_url')]
        private ?string $viewUrl= null,
        #[SerializedName('buyer_mobile_phone')]
        private mixed $buyerMobilePhone= null,
        #[SerializedName('kind_text')]
        private ?string $kindText= null,
        #[SerializedName('invoice_for_receipt_id')]
        private mixed $invoiceForReceiptId= null,
        #[SerializedName('receipt_for_invoice_id')]
        private mixed $receiptForInvoiceId= null,
        #[SerializedName('recipient_company')]
        private mixed $recipientCompany= null,
        #[SerializedName('recipient_first_name')]
        private mixed $recipientFirstName= null,
        #[SerializedName('recipient_last_name')]
        private mixed $recipientLastName= null,
        #[SerializedName('recipient_tax_no')]
        private mixed $recipientTaxNo= null,
        #[SerializedName('recipient_street')]
        private mixed $recipientStreet= null,
        #[SerializedName('recipient_post_code')]
        private mixed $recipientPostCode= null,
        #[SerializedName('recipient_city')]
        private mixed $recipientCity= null,
        #[SerializedName('recipient_country')]
        private mixed $recipientCountry= null,
        #[SerializedName('recipient_email')]
        private mixed $recipientEmail= null,
        #[SerializedName('recipient_phone')]
        private mixed $recipientPhone= null,
        #[SerializedName('recipient_note')]
        private mixed $recipientNote= null,
        private ?bool $overdue= null,
        #[SerializedName('get_tax_name')]
        private ?string $getTaxName= null,
        #[SerializedName('tax_visible')]
        private ?bool $taxVisible= null,
        #[SerializedName('tax_name_type')]
        private ?string $taxNameType= null,
        #[SerializedName('use_oss')]
        private ?bool $useOss= null,
        #[SerializedName('adjust_invoice_price')]
        private ?string $adjustInvoicePrice= null,
        #[SerializedName('check_fiscal_print')]
        private ?bool $checkFiscalPrint= null,
        #[SerializedName('fiscal_print_error')]
        private ?bool $fiscalPrintError= null,
        #[SerializedName('seller_bdo_no')]
        private mixed $sellerBdoNo= null,
        #[SerializedName('split_payment')]
        private mixed $splitPayment= null,
        #[SerializedName('gtu_codes')]
        private ?array $gtuCodes= null,
        #[SerializedName('procedure_designations')]
        private ?array $procedureDesignations= null,
        /**@var InvoicePosition[] */
        private ?array $positions= null,
        private ?array $issuers= null,
        private ?array $recipients= null,
    ) {
    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getUserId(): ?int
    {
        return $this->userId;
    }

    public function setUserId(?int $userId): void
    {
        $this->userId = $userId;
    }

    public function getApp(): mixed
    {
        return $this->app;
    }

    public function setApp(mixed $app): void
    {
        $this->app = $app;
    }

    public function getNumber(): ?string
    {
        return $this->number;
    }

    public function setNumber(?string $number): void
    {
        $this->number = $number;
    }

    public function getPlace(): mixed
    {
        return $this->place;
    }

    public function setPlace(mixed $place): void
    {
        $this->place = $place;
    }

    public function getSellDate(): ?string
    {
        return $this->sellDate;
    }

    public function setSellDate(?string $sellDate): void
    {
        $this->sellDate = $sellDate;
    }

    public function getPaymentType(): mixed
    {
        return $this->paymentType;
    }

    public function setPaymentType(mixed $paymentType): void
    {
        $this->paymentType = $paymentType;
    }

    public function getPriceNet(): ?string
    {
        return $this->priceNet;
    }
    public function getPriceNetMinor(): ?int
    {
        return $this->moneyStringToMinor($this->priceNet);
    }

    public function setPriceNet(?string $priceNet): void
    {
        $this->priceNet = $priceNet;
    }

    public function getPriceGross(): ?string
    {
        return $this->priceGross;
    }

    public function getPriceGrossMinor(): ?int
    {
        return $this->moneyStringToMinor($this->priceGross);
    }

    public function setPriceGross(?string $priceGross): void
    {
        $this->priceGross = $priceGross;
    }

    private function moneyStringToMinor(?string $value): ?int
    {
        if ($value === null) {
            return null;
        }

        $raw = trim($value);
        if ($raw === '') {
            return null;
        }

        $normalized = str_replace([' ', "\u{00A0}"], '', $raw);
        $normalized = str_replace(',', '.', $normalized);

        if (!preg_match('/^-?\d+(\.\d+)?$/', $normalized)) {
            throw new \InvalidArgumentException(sprintf('Invalid money value: "%s"', $raw));
        }

        [$zl, $gr] = array_pad(explode('.', $normalized, 2), 2, '0');

        $zlInt = (int) $zl;
        $grInt = (int) substr($gr . '00', 0, 2); // "7" => "70", "07" => "07", "070" => "07"

        $sign = $zlInt < 0 ? -1 : 1;

        return $zlInt * 100 + $sign * $grInt;
    }

    public function getCurrency(): ?string
    {
        return $this->currency;
    }

    public function setCurrency(?string $currency): void
    {
        $this->currency = $currency;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): void
    {
        $this->status = $status;
    }

    public function isPaid(): bool
    {
        return $this->status === InvoiceStatus::PAID->value &&
            $this->getPaid() === $this->getPriceGross();
    }

    public function getDescription(): mixed
    {
        return $this->description;
    }

    public function setDescription(mixed $description): void
    {
        $this->description = $description;
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

    public function getSellerStreet(): mixed
    {
        return $this->sellerStreet;
    }

    public function setSellerStreet(mixed $sellerStreet): void
    {
        $this->sellerStreet = $sellerStreet;
    }

    public function getSellerPostCode(): mixed
    {
        return $this->sellerPostCode;
    }

    public function setSellerPostCode(mixed $sellerPostCode): void
    {
        $this->sellerPostCode = $sellerPostCode;
    }

    public function getSellerCity(): mixed
    {
        return $this->sellerCity;
    }

    public function setSellerCity(mixed $sellerCity): void
    {
        $this->sellerCity = $sellerCity;
    }

    public function getSellerCountry(): mixed
    {
        return $this->sellerCountry;
    }

    public function setSellerCountry(mixed $sellerCountry): void
    {
        $this->sellerCountry = $sellerCountry;
    }

    public function getSellerEmail(): mixed
    {
        return $this->sellerEmail;
    }

    public function setSellerEmail(mixed $sellerEmail): void
    {
        $this->sellerEmail = $sellerEmail;
    }

    public function getSellerPhone(): mixed
    {
        return $this->sellerPhone;
    }

    public function setSellerPhone(mixed $sellerPhone): void
    {
        $this->sellerPhone = $sellerPhone;
    }

    public function getSellerFax(): mixed
    {
        return $this->sellerFax;
    }

    public function setSellerFax(mixed $sellerFax): void
    {
        $this->sellerFax = $sellerFax;
    }

    public function getSellerWww(): mixed
    {
        return $this->sellerWww;
    }

    public function setSellerWww(mixed $sellerWww): void
    {
        $this->sellerWww = $sellerWww;
    }

    public function getSellerPerson(): mixed
    {
        return $this->sellerPerson;
    }

    public function setSellerPerson(mixed $sellerPerson): void
    {
        $this->sellerPerson = $sellerPerson;
    }

    public function getSellerBank(): mixed
    {
        return $this->sellerBank;
    }

    public function setSellerBank(mixed $sellerBank): void
    {
        $this->sellerBank = $sellerBank;
    }

    public function getSellerBankAccount(): ?string
    {
        return $this->sellerBankAccount;
    }

    public function setSellerBankAccount(?string $sellerBankAccount): void
    {
        $this->sellerBankAccount = $sellerBankAccount;
    }

    public function getBuyerName(): ?string
    {
        return $this->buyerName;
    }

    public function setBuyerName(?string $buyerName): void
    {
        $this->buyerName = $buyerName;
    }

    public function getBuyerTaxNo(): ?string
    {
        return $this->buyerTaxNo;
    }

    public function setBuyerTaxNo(?string $buyerTaxNo): void
    {
        $this->buyerTaxNo = $buyerTaxNo;
    }

    public function getBuyerPostCode(): mixed
    {
        return $this->buyerPostCode;
    }

    public function setBuyerPostCode(mixed $buyerPostCode): void
    {
        $this->buyerPostCode = $buyerPostCode;
    }

    public function getBuyerCity(): mixed
    {
        return $this->buyerCity;
    }

    public function setBuyerCity(mixed $buyerCity): void
    {
        $this->buyerCity = $buyerCity;
    }

    public function getBuyerStreet(): mixed
    {
        return $this->buyerStreet;
    }

    public function setBuyerStreet(mixed $buyerStreet): void
    {
        $this->buyerStreet = $buyerStreet;
    }

    public function getBuyerFirstName(): mixed
    {
        return $this->buyerFirstName;
    }

    public function setBuyerFirstName(mixed $buyerFirstName): void
    {
        $this->buyerFirstName = $buyerFirstName;
    }

    public function getBuyerCountry(): mixed
    {
        return $this->buyerCountry;
    }

    public function setBuyerCountry(mixed $buyerCountry): void
    {
        $this->buyerCountry = $buyerCountry;
    }

    public function getCreatedAt(): ?string
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?string $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    public function getUpdatedAt(): ?string
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?string $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }

    public function getToken(): ?string
    {
        return $this->token;
    }

    public function setToken(?string $token): void
    {
        $this->token = $token;
    }

    public function getBuyerEmail(): mixed
    {
        return $this->buyerEmail;
    }

    public function setBuyerEmail(mixed $buyerEmail): void
    {
        $this->buyerEmail = $buyerEmail;
    }

    public function getBuyerWww(): mixed
    {
        return $this->buyerWww;
    }

    public function setBuyerWww(mixed $buyerWww): void
    {
        $this->buyerWww = $buyerWww;
    }

    public function getBuyerFax(): mixed
    {
        return $this->buyerFax;
    }

    public function setBuyerFax(mixed $buyerFax): void
    {
        $this->buyerFax = $buyerFax;
    }

    public function getBuyerPhone(): mixed
    {
        return $this->buyerPhone;
    }

    public function setBuyerPhone(mixed $buyerPhone): void
    {
        $this->buyerPhone = $buyerPhone;
    }

    public function getKind(): ?string
    {
        return $this->kind;
    }

    public function setKind(?string $kind): void
    {
        $this->kind = $kind;
    }

    public function getPattern(): ?string
    {
        return $this->pattern;
    }

    public function setPattern(?string $pattern): void
    {
        $this->pattern = $pattern;
    }

    public function getPatternNr(): mixed
    {
        return $this->patternNr;
    }

    public function setPatternNr(mixed $patternNr): void
    {
        $this->patternNr = $patternNr;
    }

    public function getPatternNrM(): ?int
    {
        return $this->patternNrM;
    }

    public function setPatternNrM(?int $patternNrM): void
    {
        $this->patternNrM = $patternNrM;
    }

    public function getPatternNrD(): mixed
    {
        return $this->patternNrD;
    }

    public function setPatternNrD(mixed $patternNrD): void
    {
        $this->patternNrD = $patternNrD;
    }

    public function getClientId(): ?int
    {
        return $this->clientId;
    }

    public function setClientId(?int $clientId): void
    {
        $this->clientId = $clientId;
    }

    public function getPaymentTo(): ?string
    {
        return $this->paymentTo;
    }

    public function setPaymentTo(?string $paymentTo): void
    {
        $this->paymentTo = $paymentTo;
    }

    public function getPaid(): ?string
    {
        return $this->paid;
    }

    public function setPaid(?string $paid): void
    {
        $this->paid = $paid;
    }

    public function getSellerBankAccountId(): mixed
    {
        return $this->sellerBankAccountId;
    }

    public function setSellerBankAccountId(mixed $sellerBankAccountId): void
    {
        $this->sellerBankAccountId = $sellerBankAccountId;
    }

    public function getLang(): ?string
    {
        return $this->lang;
    }

    public function setLang(?string $lang): void
    {
        $this->lang = $lang;
    }

    public function getIssueDate(): ?string
    {
        return $this->issueDate;
    }

    public function setIssueDate(?string $issueDate): void
    {
        $this->issueDate = $issueDate;
    }

    public function getPriceTax(): ?string
    {
        return $this->priceTax;
    }

    public function getPriceTaxMinor(): ?int
    {
        return $this->moneyStringToMinor($this->priceTax);
    }

    public function setPriceTax(?string $priceTax): void
    {
        $this->priceTax = $priceTax;
    }

    public function getDepartmentId(): ?int
    {
        return $this->departmentId;
    }

    public function setDepartmentId(?int $departmentId): void
    {
        $this->departmentId = $departmentId;
    }

    public function getCorrection(): mixed
    {
        return $this->correction;
    }

    public function setCorrection(mixed $correction): void
    {
        $this->correction = $correction;
    }

    public function getBuyerNote(): mixed
    {
        return $this->buyerNote;
    }

    public function setBuyerNote(mixed $buyerNote): void
    {
        $this->buyerNote = $buyerNote;
    }

    public function getAdditionalInfoDesc(): mixed
    {
        return $this->additionalInfoDesc;
    }

    public function setAdditionalInfoDesc(mixed $additionalInfoDesc): void
    {
        $this->additionalInfoDesc = $additionalInfoDesc;
    }

    public function getAdditionalInfo(): ?bool
    {
        return $this->additionalInfo;
    }

    public function setAdditionalInfo(?bool $additionalInfo): void
    {
        $this->additionalInfo = $additionalInfo;
    }

    public function getProductCache(): ?string
    {
        return $this->productCache;
    }

    public function setProductCache(?string $productCache): void
    {
        $this->productCache = $productCache;
    }

    public function getBuyerLastName(): mixed
    {
        return $this->buyerLastName;
    }

    public function setBuyerLastName(mixed $buyerLastName): void
    {
        $this->buyerLastName = $buyerLastName;
    }

    public function getFromInvoiceId(): mixed
    {
        return $this->fromInvoiceId;
    }

    public function setFromInvoiceId(mixed $fromInvoiceId): void
    {
        $this->fromInvoiceId = $fromInvoiceId;
    }

    public function getOid(): mixed
    {
        return $this->oid;
    }

    public function setOid(mixed $oid): void
    {
        $this->oid = $oid;
    }

    public function getDiscount(): ?string
    {
        return $this->discount;
    }

    public function setDiscount(?string $discount): void
    {
        $this->discount = $discount;
    }

    public function getShowDiscount(): ?bool
    {
        return $this->showDiscount;
    }

    public function setShowDiscount(?bool $showDiscount): void
    {
        $this->showDiscount = $showDiscount;
    }

    public function getSentTime(): mixed
    {
        return $this->sentTime;
    }

    public function setSentTime(mixed $sentTime): void
    {
        $this->sentTime = $sentTime;
    }

    public function getPrintTime(): mixed
    {
        return $this->printTime;
    }

    public function setPrintTime(mixed $printTime): void
    {
        $this->printTime = $printTime;
    }

    public function getRecurringId(): mixed
    {
        return $this->recurringId;
    }

    public function setRecurringId(mixed $recurringId): void
    {
        $this->recurringId = $recurringId;
    }

    public function getTax2Visible(): mixed
    {
        return $this->tax2Visible;
    }

    public function setTax2Visible(mixed $tax2Visible): void
    {
        $this->tax2Visible = $tax2Visible;
    }

    public function getWarehouseId(): mixed
    {
        return $this->warehouseId;
    }

    public function setWarehouseId(mixed $warehouseId): void
    {
        $this->warehouseId = $warehouseId;
    }

    public function getPaidDate(): mixed
    {
        return $this->paidDate;
    }

    public function setPaidDate(mixed $paidDate): void
    {
        $this->paidDate = $paidDate;
    }

    public function getProductId(): ?int
    {
        return $this->productId;
    }

    public function setProductId(?int $productId): void
    {
        $this->productId = $productId;
    }

    public function getIssueYear(): ?int
    {
        return $this->issueYear;
    }

    public function setIssueYear(?int $issueYear): void
    {
        $this->issueYear = $issueYear;
    }

    public function getInternalNote(): mixed
    {
        return $this->internalNote;
    }

    public function setInternalNote(mixed $internalNote): void
    {
        $this->internalNote = $internalNote;
    }

    public function getInvoiceId(): mixed
    {
        return $this->invoiceId;
    }

    public function setInvoiceId(mixed $invoiceId): void
    {
        $this->invoiceId = $invoiceId;
    }

    public function getInvoiceTemplateId(): ?int
    {
        return $this->invoiceTemplateId;
    }

    public function setInvoiceTemplateId(?int $invoiceTemplateId): void
    {
        $this->invoiceTemplateId = $invoiceTemplateId;
    }

    public function getDescriptionLong(): mixed
    {
        return $this->descriptionLong;
    }

    public function setDescriptionLong(mixed $descriptionLong): void
    {
        $this->descriptionLong = $descriptionLong;
    }

    public function getBuyerTaxNoKind(): mixed
    {
        return $this->buyerTaxNoKind;
    }

    public function setBuyerTaxNoKind(mixed $buyerTaxNoKind): void
    {
        $this->buyerTaxNoKind = $buyerTaxNoKind;
    }

    public function getSellerTaxNoKind(): mixed
    {
        return $this->sellerTaxNoKind;
    }

    public function setSellerTaxNoKind(mixed $sellerTaxNoKind): void
    {
        $this->sellerTaxNoKind = $sellerTaxNoKind;
    }

    public function getDescriptionFooter(): mixed
    {
        return $this->descriptionFooter;
    }

    public function setDescriptionFooter(mixed $descriptionFooter): void
    {
        $this->descriptionFooter = $descriptionFooter;
    }

    public function getSellDateKind(): mixed
    {
        return $this->sellDateKind;
    }

    public function setSellDateKind(mixed $sellDateKind): void
    {
        $this->sellDateKind = $sellDateKind;
    }

    public function getPaymentToKind(): ?string
    {
        return $this->paymentToKind;
    }

    public function setPaymentToKind(?string $paymentToKind): void
    {
        $this->paymentToKind = $paymentToKind;
    }

    public function getExchangeCurrency(): mixed
    {
        return $this->exchangeCurrency;
    }

    public function setExchangeCurrency(mixed $exchangeCurrency): void
    {
        $this->exchangeCurrency = $exchangeCurrency;
    }

    public function getDiscountKind(): ?string
    {
        return $this->discountKind;
    }

    public function setDiscountKind(?string $discountKind): void
    {
        $this->discountKind = $discountKind;
    }

    public function getIncome(): ?bool
    {
        return $this->income;
    }

    public function setIncome(?bool $income): void
    {
        $this->income = $income;
    }

    public function getFromApi(): ?bool
    {
        return $this->fromApi;
    }

    public function setFromApi(?bool $fromApi): void
    {
        $this->fromApi = $fromApi;
    }

    public function getCategoryId(): mixed
    {
        return $this->categoryId;
    }

    public function setCategoryId(mixed $categoryId): void
    {
        $this->categoryId = $categoryId;
    }

    public function getWarehouseDocumentId(): mixed
    {
        return $this->warehouseDocumentId;
    }

    public function setWarehouseDocumentId(mixed $warehouseDocumentId): void
    {
        $this->warehouseDocumentId = $warehouseDocumentId;
    }

    public function getExchangeKind(): ?string
    {
        return $this->exchangeKind;
    }

    public function setExchangeKind(?string $exchangeKind): void
    {
        $this->exchangeKind = $exchangeKind;
    }

    public function getExchangeRate(): ?string
    {
        return $this->exchangeRate;
    }

    public function setExchangeRate(?string $exchangeRate): void
    {
        $this->exchangeRate = $exchangeRate;
    }

    public function getUseDeliveryAddress(): ?bool
    {
        return $this->useDeliveryAddress;
    }

    public function setUseDeliveryAddress(?bool $useDeliveryAddress): void
    {
        $this->useDeliveryAddress = $useDeliveryAddress;
    }

    public function getDeliveryAddress(): mixed
    {
        return $this->deliveryAddress;
    }

    public function setDeliveryAddress(mixed $deliveryAddress): void
    {
        $this->deliveryAddress = $deliveryAddress;
    }

    public function getAccountingKind(): mixed
    {
        return $this->accountingKind;
    }

    public function setAccountingKind(mixed $accountingKind): void
    {
        $this->accountingKind = $accountingKind;
    }

    public function getBuyerPerson(): ?string
    {
        return $this->buyerPerson;
    }

    public function setBuyerPerson(?string $buyerPerson): void
    {
        $this->buyerPerson = $buyerPerson;
    }

    public function getBuyerBankAccount(): mixed
    {
        return $this->buyerBankAccount;
    }

    public function setBuyerBankAccount(mixed $buyerBankAccount): void
    {
        $this->buyerBankAccount = $buyerBankAccount;
    }

    public function getBuyerBank(): mixed
    {
        return $this->buyerBank;
    }

    public function setBuyerBank(mixed $buyerBank): void
    {
        $this->buyerBank = $buyerBank;
    }

    public function getBuyerMassPaymentCode(): mixed
    {
        return $this->buyerMassPaymentCode;
    }

    public function setBuyerMassPaymentCode(mixed $buyerMassPaymentCode): void
    {
        $this->buyerMassPaymentCode = $buyerMassPaymentCode;
    }

    public function getExchangeNote(): ?string
    {
        return $this->exchangeNote;
    }

    public function setExchangeNote(?string $exchangeNote): void
    {
        $this->exchangeNote = $exchangeNote;
    }

    public function getBuyerCompany(): ?bool
    {
        return $this->buyerCompany;
    }

    public function setBuyerCompany(?bool $buyerCompany): void
    {
        $this->buyerCompany = $buyerCompany;
    }

    public function getShowAttachments(): ?bool
    {
        return $this->showAttachments;
    }

    public function setShowAttachments(?bool $showAttachments): void
    {
        $this->showAttachments = $showAttachments;
    }

    public function getExchangeCurrencyRate(): mixed
    {
        return $this->exchangeCurrencyRate;
    }

    public function setExchangeCurrencyRate(mixed $exchangeCurrencyRate): void
    {
        $this->exchangeCurrencyRate = $exchangeCurrencyRate;
    }

    public function getHasAttachments(): ?bool
    {
        return $this->hasAttachments;
    }

    public function setHasAttachments(?bool $hasAttachments): void
    {
        $this->hasAttachments = $hasAttachments;
    }

    public function getExchangeDate(): mixed
    {
        return $this->exchangeDate;
    }

    public function setExchangeDate(mixed $exchangeDate): void
    {
        $this->exchangeDate = $exchangeDate;
    }

    public function getAttachmentsCount(): ?int
    {
        return $this->attachmentsCount;
    }

    public function setAttachmentsCount(?int $attachmentsCount): void
    {
        $this->attachmentsCount = $attachmentsCount;
    }

    public function getDeliveryDate(): ?string
    {
        return $this->deliveryDate;
    }

    public function setDeliveryDate(?string $deliveryDate): void
    {
        $this->deliveryDate = $deliveryDate;
    }

    public function getFiscalStatus(): mixed
    {
        return $this->fiscalStatus;
    }

    public function setFiscalStatus(mixed $fiscalStatus): void
    {
        $this->fiscalStatus = $fiscalStatus;
    }

    public function getUseMoss(): ?bool
    {
        return $this->useMoss;
    }

    public function setUseMoss(?bool $useMoss): void
    {
        $this->useMoss = $useMoss;
    }

    public function getCalculatingStrategy(): ?array
    {
        return $this->calculatingStrategy;
    }

    public function setCalculatingStrategy(?array $calculatingStrategy): void
    {
        $this->calculatingStrategy = $calculatingStrategy;
    }

    public function getTransactionDate(): ?string
    {
        return $this->transactionDate;
    }

    public function setTransactionDate(?string $transactionDate): void
    {
        $this->transactionDate = $transactionDate;
    }

    public function getEmailStatus(): mixed
    {
        return $this->emailStatus;
    }

    public function setEmailStatus(mixed $emailStatus): void
    {
        $this->emailStatus = $emailStatus;
    }

    public function getExcludeFromStockLevel(): ?bool
    {
        return $this->excludeFromStockLevel;
    }

    public function setExcludeFromStockLevel(?bool $excludeFromStockLevel): void
    {
        $this->excludeFromStockLevel = $excludeFromStockLevel;
    }

    public function getExcludeFromAccounting(): ?bool
    {
        return $this->excludeFromAccounting;
    }

    public function setExcludeFromAccounting(?bool $excludeFromAccounting): void
    {
        $this->excludeFromAccounting = $excludeFromAccounting;
    }

    public function getExchangeRateDen(): ?string
    {
        return $this->exchangeRateDen;
    }

    public function setExchangeRateDen(?string $exchangeRateDen): void
    {
        $this->exchangeRateDen = $exchangeRateDen;
    }

    public function getExchangeCurrencyRateDen(): ?string
    {
        return $this->exchangeCurrencyRateDen;
    }

    public function setExchangeCurrencyRateDen(?string $exchangeCurrencyRateDen): void
    {
        $this->exchangeCurrencyRateDen = $exchangeCurrencyRateDen;
    }

    public function getAccountingScheme(): mixed
    {
        return $this->accountingScheme;
    }

    public function setAccountingScheme(mixed $accountingScheme): void
    {
        $this->accountingScheme = $accountingScheme;
    }

    public function getExchangeDifference(): ?string
    {
        return $this->exchangeDifference;
    }

    public function setExchangeDifference(?string $exchangeDifference): void
    {
        $this->exchangeDifference = $exchangeDifference;
    }

    public function getNotCost(): ?bool
    {
        return $this->notCost;
    }

    public function setNotCost(?bool $notCost): void
    {
        $this->notCost = $notCost;
    }

    public function getReverseCharge(): ?bool
    {
        return $this->reverseCharge;
    }

    public function setReverseCharge(?bool $reverseCharge): void
    {
        $this->reverseCharge = $reverseCharge;
    }

    public function getIssuer(): mixed
    {
        return $this->issuer;
    }

    public function setIssuer(mixed $issuer): void
    {
        $this->issuer = $issuer;
    }

    public function getUseIssuer(): ?bool
    {
        return $this->useIssuer;
    }

    public function setUseIssuer(?bool $useIssuer): void
    {
        $this->useIssuer = $useIssuer;
    }

    public function getCancelled(): ?bool
    {
        return $this->cancelled;
    }

    public function setCancelled(?bool $cancelled): void
    {
        $this->cancelled = $cancelled;
    }

    public function getRecipientId(): mixed
    {
        return $this->recipientId;
    }

    public function setRecipientId(mixed $recipientId): void
    {
        $this->recipientId = $recipientId;
    }

    public function getRecipientName(): ?string
    {
        return $this->recipientName;
    }

    public function setRecipientName(?string $recipientName): void
    {
        $this->recipientName = $recipientName;
    }

    public function getTest(): ?bool
    {
        return $this->test;
    }

    public function setTest(?bool $test): void
    {
        $this->test = $test;
    }

    public function getDiscountNet(): ?string
    {
        return $this->discountNet;
    }

    public function setDiscountNet(?string $discountNet): void
    {
        $this->discountNet = $discountNet;
    }

    public function getApprovalStatus(): mixed
    {
        return $this->approvalStatus;
    }

    public function setApprovalStatus(mixed $approvalStatus): void
    {
        $this->approvalStatus = $approvalStatus;
    }

    public function getAccountingVatTaxDate(): ?string
    {
        return $this->accountingVatTaxDate;
    }

    public function setAccountingVatTaxDate(?string $accountingVatTaxDate): void
    {
        $this->accountingVatTaxDate = $accountingVatTaxDate;
    }

    public function getAccountingIncomeTaxDate(): ?string
    {
        return $this->accountingIncomeTaxDate;
    }

    public function setAccountingIncomeTaxDate(?string $accountingIncomeTaxDate): void
    {
        $this->accountingIncomeTaxDate = $accountingIncomeTaxDate;
    }

    public function getAccountingOtherTaxDate(): mixed
    {
        return $this->accountingOtherTaxDate;
    }

    public function setAccountingOtherTaxDate(mixed $accountingOtherTaxDate): void
    {
        $this->accountingOtherTaxDate = $accountingOtherTaxDate;
    }

    public function getAccountingStatus(): mixed
    {
        return $this->accountingStatus;
    }

    public function setAccountingStatus(mixed $accountingStatus): void
    {
        $this->accountingStatus = $accountingStatus;
    }

    public function getNormalizedNumber(): mixed
    {
        return $this->normalizedNumber;
    }

    public function setNormalizedNumber(mixed $normalizedNumber): void
    {
        $this->normalizedNumber = $normalizedNumber;
    }

    public function getNaTaxKind(): mixed
    {
        return $this->naTaxKind;
    }

    public function setNaTaxKind(mixed $naTaxKind): void
    {
        $this->naTaxKind = $naTaxKind;
    }

    public function getIssuedToReceipt(): ?bool
    {
        return $this->issuedToReceipt;
    }

    public function setIssuedToReceipt(?bool $issuedToReceipt): void
    {
        $this->issuedToReceipt = $issuedToReceipt;
    }

    public function getGovId(): mixed
    {
        return $this->govId;
    }

    public function setGovId(mixed $govId): void
    {
        $this->govId = $govId;
    }

    public function getGovKind(): mixed
    {
        return $this->govKind;
    }

    public function setGovKind(mixed $govKind): void
    {
        $this->govKind = $govKind;
    }

    public function getGovStatus(): mixed
    {
        return $this->govStatus;
    }

    public function setGovStatus(mixed $govStatus): void
    {
        $this->govStatus = $govStatus;
    }

    public function getSalesCode(): ?string
    {
        return $this->salesCode;
    }

    public function setSalesCode(?string $salesCode): void
    {
        $this->salesCode = $salesCode;
    }

    public function getAdditionalInvoiceField(): mixed
    {
        return $this->additionalInvoiceField;
    }

    public function setAdditionalInvoiceField(mixed $additionalInvoiceField): void
    {
        $this->additionalInvoiceField = $additionalInvoiceField;
    }

    public function getProductsMargin(): mixed
    {
        return $this->productsMargin;
    }

    public function setProductsMargin(mixed $productsMargin): void
    {
        $this->productsMargin = $productsMargin;
    }

    public function getPaymentUrl(): ?string
    {
        return $this->paymentUrl;
    }

    public function setPaymentUrl(?string $paymentUrl): void
    {
        $this->paymentUrl = $paymentUrl;
    }

    public function getViewUrl(): ?string
    {
        return $this->viewUrl;
    }

    public function setViewUrl(?string $viewUrl): void
    {
        $this->viewUrl = $viewUrl;
    }

    public function getBuyerMobilePhone(): mixed
    {
        return $this->buyerMobilePhone;
    }

    public function setBuyerMobilePhone(mixed $buyerMobilePhone): void
    {
        $this->buyerMobilePhone = $buyerMobilePhone;
    }

    public function getKindText(): ?string
    {
        return $this->kindText;
    }

    public function setKindText(?string $kindText): void
    {
        $this->kindText = $kindText;
    }

    public function getInvoiceForReceiptId(): mixed
    {
        return $this->invoiceForReceiptId;
    }

    public function setInvoiceForReceiptId(mixed $invoiceForReceiptId): void
    {
        $this->invoiceForReceiptId = $invoiceForReceiptId;
    }

    public function getReceiptForInvoiceId(): mixed
    {
        return $this->receiptForInvoiceId;
    }

    public function setReceiptForInvoiceId(mixed $receiptForInvoiceId): void
    {
        $this->receiptForInvoiceId = $receiptForInvoiceId;
    }

    public function getRecipientCompany(): mixed
    {
        return $this->recipientCompany;
    }

    public function setRecipientCompany(mixed $recipientCompany): void
    {
        $this->recipientCompany = $recipientCompany;
    }

    public function getRecipientFirstName(): mixed
    {
        return $this->recipientFirstName;
    }

    public function setRecipientFirstName(mixed $recipientFirstName): void
    {
        $this->recipientFirstName = $recipientFirstName;
    }

    public function getRecipientLastName(): mixed
    {
        return $this->recipientLastName;
    }

    public function setRecipientLastName(mixed $recipientLastName): void
    {
        $this->recipientLastName = $recipientLastName;
    }

    public function getRecipientTaxNo(): mixed
    {
        return $this->recipientTaxNo;
    }

    public function setRecipientTaxNo(mixed $recipientTaxNo): void
    {
        $this->recipientTaxNo = $recipientTaxNo;
    }

    public function getRecipientStreet(): mixed
    {
        return $this->recipientStreet;
    }

    public function setRecipientStreet(mixed $recipientStreet): void
    {
        $this->recipientStreet = $recipientStreet;
    }

    public function getRecipientPostCode(): mixed
    {
        return $this->recipientPostCode;
    }

    public function setRecipientPostCode(mixed $recipientPostCode): void
    {
        $this->recipientPostCode = $recipientPostCode;
    }

    public function getRecipientCity(): mixed
    {
        return $this->recipientCity;
    }

    public function setRecipientCity(mixed $recipientCity): void
    {
        $this->recipientCity = $recipientCity;
    }

    public function getRecipientCountry(): mixed
    {
        return $this->recipientCountry;
    }

    public function setRecipientCountry(mixed $recipientCountry): void
    {
        $this->recipientCountry = $recipientCountry;
    }

    public function getRecipientEmail(): mixed
    {
        return $this->recipientEmail;
    }

    public function setRecipientEmail(mixed $recipientEmail): void
    {
        $this->recipientEmail = $recipientEmail;
    }

    public function getRecipientPhone(): mixed
    {
        return $this->recipientPhone;
    }

    public function setRecipientPhone(mixed $recipientPhone): void
    {
        $this->recipientPhone = $recipientPhone;
    }

    public function getRecipientNote(): mixed
    {
        return $this->recipientNote;
    }

    public function setRecipientNote(mixed $recipientNote): void
    {
        $this->recipientNote = $recipientNote;
    }

    public function getOverdue(): ?bool
    {
        return $this->overdue;
    }

    public function setOverdue(?bool $overdue): void
    {
        $this->overdue = $overdue;
    }

    public function getGetTaxName(): ?string
    {
        return $this->getTaxName;
    }

    public function setGetTaxName(?string $getTaxName): void
    {
        $this->getTaxName = $getTaxName;
    }

    public function getTaxVisible(): ?bool
    {
        return $this->taxVisible;
    }

    public function setTaxVisible(?bool $taxVisible): void
    {
        $this->taxVisible = $taxVisible;
    }

    public function getTaxNameType(): ?string
    {
        return $this->taxNameType;
    }

    public function setTaxNameType(?string $taxNameType): void
    {
        $this->taxNameType = $taxNameType;
    }

    public function getUseOss(): ?bool
    {
        return $this->useOss;
    }

    public function setUseOss(?bool $useOss): void
    {
        $this->useOss = $useOss;
    }

    public function getAdjustInvoicePrice(): ?string
    {
        return $this->adjustInvoicePrice;
    }

    public function setAdjustInvoicePrice(?string $adjustInvoicePrice): void
    {
        $this->adjustInvoicePrice = $adjustInvoicePrice;
    }

    public function getCheckFiscalPrint(): ?bool
    {
        return $this->checkFiscalPrint;
    }

    public function setCheckFiscalPrint(?bool $checkFiscalPrint): void
    {
        $this->checkFiscalPrint = $checkFiscalPrint;
    }

    public function getFiscalPrintError(): ?bool
    {
        return $this->fiscalPrintError;
    }

    public function setFiscalPrintError(?bool $fiscalPrintError): void
    {
        $this->fiscalPrintError = $fiscalPrintError;
    }

    public function getSellerBdoNo(): mixed
    {
        return $this->sellerBdoNo;
    }

    public function setSellerBdoNo(mixed $sellerBdoNo): void
    {
        $this->sellerBdoNo = $sellerBdoNo;
    }

    public function getSplitPayment(): mixed
    {
        return $this->splitPayment;
    }

    public function setSplitPayment(mixed $splitPayment): void
    {
        $this->splitPayment = $splitPayment;
    }

    public function getGtuCodes(): ?array
    {
        return $this->gtuCodes;
    }

    public function setGtuCodes(?array $gtuCodes): void
    {
        $this->gtuCodes = $gtuCodes;
    }

    public function getProcedureDesignations(): ?array
    {
        return $this->procedureDesignations;
    }

    public function setProcedureDesignations(?array $procedureDesignations): void
    {
        $this->procedureDesignations = $procedureDesignations;
    }

    public function getPositions(): ?array
    {
        return $this->positions;
    }

    public function setPositions(?array $positions): void
    {
        $this->positions = $positions;
    }

    public function getIssuers(): ?array
    {
        return $this->issuers;
    }

    public function setIssuers(?array $issuers): void
    {
        $this->issuers = $issuers;
    }

    public function getRecipients(): ?array
    {
        return $this->recipients;
    }

    public function setRecipients(?array $recipients): void
    {
        $this->recipients = $recipients;
    }
}
