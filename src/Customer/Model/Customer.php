<?php

namespace Codevenom\FakturowniaBundle\Customer\Model;

use Symfony\Component\Serializer\Annotation\SerializedName;

class Customer
{
    private ?int $id = null;
    private ?string $name = null;
    #[SerializedName('tax_no')]
    private ?string $taxNo = null;
    #[SerializedName('post_code')]
    private ?string $postCode = null;
    private ?string $city = null;
    private ?string $street = null;
    #[SerializedName('first_name')]
    private ?string $firstName = null;
    private ?string $country = null;
    private ?string $email = null;
    private ?string $phone = null;
    private ?string $www = null;
    private ?string $fax = null;
    #[SerializedName('created_at')]
    private ?string $createdAt = null;
    #[SerializedName('updated_at')]
    private ?string $updatedAt = null;
    #[SerializedName('street_no')]
    private ?string $streetNo = null;
    private ?string $kind = null;
    private ?string $bank = null;
    #[SerializedName('bank_account')]
    private ?string $bankAccount = null;
    #[SerializedName('bank_account_id')]
    private ?string $bankAccountId = null;
    private ?string $shortcut = null;
    private ?string $note = null;
    #[SerializedName('last_name')]
    private ?string $lastName = null;
    private ?string $referrer = null;
    private ?string $token = null;
    private ?string $fuid = null;
    private ?string $fname = null;
    private ?string $femail = null;
    #[SerializedName('department_id')]
    private ?int $departmentId = null;
    private ?string $import = null;
    private ?string $discount = null;
    #[SerializedName('payment_to_kind')]
    private ?string $paymentToKind = null;
    #[SerializedName('category_id')]
    private ?int $categoryId = null;
    #[SerializedName('use_delivery_address')]
    private bool $useDeliveryAddress = false;
    #[SerializedName('delivery_address')]
    private ?string $deliveryAddress = null;
    private ?string $person = null;
    #[SerializedName('panel_user_id')]
    private ?int $panelUserId = null;
    #[SerializedName('use_mass_payment')]
    private bool $useMassPayment = false;
    #[SerializedName('mass_payment_code')]
    private ?string $massPaymentCode = null;
    #[SerializedName('external_id')]
    private ?string $externalId = null;
    private bool $company = true;
    private ?string $title = null;
    #[SerializedName('mobile_phone')]
    private ?string $mobilePhone = null;
    #[SerializedName('register_number')]
    private ?string $registerNumber = null;
    #[SerializedName('tax_no_check')]
    private ?string $taxNoCheck = null;
    #[SerializedName('attachments_count')]
    private int $attachmentsCount = 0;
    #[SerializedName('default_payment_type')]
    private ?string $defaultPaymentType = null;
    #[SerializedName('tax_no_kind')]
    private ?string $taxNoKind = null;
    #[SerializedName('accounting_id')]
    private ?string $accountingId = null;
    #[SerializedName('disable_auto_reminders')]
    private bool $disableAutoReminders = false;
    #[SerializedName('buyer_id')]
    private ?int $buyerId = null;
    #[SerializedName('price_list_id')]
    private ?int $priceListId = null;
    #[SerializedName('search_data')]
    private ?string $searchData = null;
    #[SerializedName('panel_url')]
    private ?string $panelUrl = null;
    #[SerializedName('use_postal_address')]
    private ?bool $usePostalAddress = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    public function getTaxNo(): ?string
    {
        return $this->taxNo;
    }

    public function setTaxNo(?string $taxNo): void
    {
        $this->taxNo = $taxNo;
    }

    public function getPostCode(): ?string
    {
        return $this->postCode;
    }

    public function setPostCode(?string $postCode): void
    {
        $this->postCode = $postCode;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(?string $city): void
    {
        $this->city = $city;
    }

    public function getStreet(): ?string
    {
        return $this->street;
    }

    public function setStreet(?string $street): void
    {
        $this->street = $street;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(?string $firstName): void
    {
        $this->firstName = $firstName;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(?string $country): void
    {
        $this->country = $country;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): void
    {
        $this->phone = $phone;
    }

    public function getWww(): ?string
    {
        return $this->www;
    }

    public function setWww(?string $www): void
    {
        $this->www = $www;
    }

    public function getFax(): ?string
    {
        return $this->fax;
    }

    public function setFax(?string $fax): void
    {
        $this->fax = $fax;
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

    public function getStreetNo(): ?string
    {
        return $this->streetNo;
    }

    public function setStreetNo(?string $streetNo): void
    {
        $this->streetNo = $streetNo;
    }

    public function getKind(): ?string
    {
        return $this->kind;
    }

    public function setKind(?string $kind): void
    {
        $this->kind = $kind;
    }

    public function getBank(): ?string
    {
        return $this->bank;
    }

    public function setBank(?string $bank): void
    {
        $this->bank = $bank;
    }

    public function getBankAccount(): ?string
    {
        return $this->bankAccount;
    }

    public function setBankAccount(?string $bankAccount): void
    {
        $this->bankAccount = $bankAccount;
    }

    public function getBankAccountId(): ?string
    {
        return $this->bankAccountId;
    }

    public function setBankAccountId(?string $bankAccountId): void
    {
        $this->bankAccountId = $bankAccountId;
    }

    public function getShortcut(): ?string
    {
        return $this->shortcut;
    }

    public function setShortcut(?string $shortcut): void
    {
        $this->shortcut = $shortcut;
    }

    public function getNote(): ?string
    {
        return $this->note;
    }

    public function setNote(?string $note): void
    {
        $this->note = $note;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(?string $lastName): void
    {
        $this->lastName = $lastName;
    }

    public function getReferrer(): ?string
    {
        return $this->referrer;
    }

    public function setReferrer(?string $referrer): void
    {
        $this->referrer = $referrer;
    }

    public function getToken(): ?string
    {
        return $this->token;
    }

    public function setToken(?string $token): void
    {
        $this->token = $token;
    }

    public function getFuid(): ?string
    {
        return $this->fuid;
    }

    public function setFuid(?string $fuid): void
    {
        $this->fuid = $fuid;
    }

    public function getFname(): ?string
    {
        return $this->fname;
    }

    public function setFname(?string $fname): void
    {
        $this->fname = $fname;
    }

    public function getFemail(): ?string
    {
        return $this->femail;
    }

    public function setFemail(?string $femail): void
    {
        $this->femail = $femail;
    }

    public function getDepartmentId(): ?int
    {
        return $this->departmentId;
    }

    public function setDepartmentId(?int $departmentId): void
    {
        $this->departmentId = $departmentId;
    }

    public function getImport(): ?string
    {
        return $this->import;
    }

    public function setImport(?string $import): void
    {
        $this->import = $import;
    }

    public function getDiscount(): ?string
    {
        return $this->discount;
    }

    public function setDiscount(?string $discount): void
    {
        $this->discount = $discount;
    }

    public function getPaymentToKind(): ?string
    {
        return $this->paymentToKind;
    }

    public function setPaymentToKind(?string $paymentToKind): void
    {
        $this->paymentToKind = $paymentToKind;
    }

    public function getCategoryId(): ?int
    {
        return $this->categoryId;
    }

    public function setCategoryId(?int $categoryId): void
    {
        $this->categoryId = $categoryId;
    }

    public function isUseDeliveryAddress(): bool
    {
        return $this->useDeliveryAddress;
    }

    public function setUseDeliveryAddress(bool $useDeliveryAddress): void
    {
        $this->useDeliveryAddress = $useDeliveryAddress;
    }

    public function getDeliveryAddress(): ?string
    {
        return $this->deliveryAddress;
    }

    public function setDeliveryAddress(?string $deliveryAddress): void
    {
        $this->deliveryAddress = $deliveryAddress;
    }

    public function getPerson(): ?string
    {
        return $this->person;
    }

    public function setPerson(?string $person): void
    {
        $this->person = $person;
    }

    public function getPanelUserId(): ?int
    {
        return $this->panelUserId;
    }

    public function setPanelUserId(?int $panelUserId): void
    {
        $this->panelUserId = $panelUserId;
    }

    public function isUseMassPayment(): bool
    {
        return $this->useMassPayment;
    }

    public function setUseMassPayment(bool $useMassPayment): void
    {
        $this->useMassPayment = $useMassPayment;
    }

    public function getMassPaymentCode(): ?string
    {
        return $this->massPaymentCode;
    }

    public function setMassPaymentCode(?string $massPaymentCode): void
    {
        $this->massPaymentCode = $massPaymentCode;
    }

    public function getExternalId(): ?string
    {
        return $this->externalId;
    }

    public function setExternalId(?string $externalId): void
    {
        $this->externalId = $externalId;
    }

    public function isCompany(): bool
    {
        return $this->company;
    }

    public function setCompany(bool $company): void
    {
        $this->company = $company;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): void
    {
        $this->title = $title;
    }

    public function getMobilePhone(): ?string
    {
        return $this->mobilePhone;
    }

    public function setMobilePhone(?string $mobilePhone): void
    {
        $this->mobilePhone = $mobilePhone;
    }

    public function getRegisterNumber(): ?string
    {
        return $this->registerNumber;
    }

    public function setRegisterNumber(?string $registerNumber): void
    {
        $this->registerNumber = $registerNumber;
    }

    public function getTaxNoCheck(): ?string
    {
        return $this->taxNoCheck;
    }

    public function setTaxNoCheck(?string $taxNoCheck): void
    {
        $this->taxNoCheck = $taxNoCheck;
    }

    public function getAttachmentsCount(): int
    {
        return $this->attachmentsCount;
    }

    public function setAttachmentsCount(int $attachmentsCount): void
    {
        $this->attachmentsCount = $attachmentsCount;
    }

    public function getDefaultPaymentType(): ?string
    {
        return $this->defaultPaymentType;
    }

    public function setDefaultPaymentType(?string $defaultPaymentType): void
    {
        $this->defaultPaymentType = $defaultPaymentType;
    }

    public function getTaxNoKind(): ?string
    {
        return $this->taxNoKind;
    }

    public function setTaxNoKind(?string $taxNoKind): void
    {
        $this->taxNoKind = $taxNoKind;
    }

    public function getAccountingId(): ?string
    {
        return $this->accountingId;
    }

    public function setAccountingId(?string $accountingId): void
    {
        $this->accountingId = $accountingId;
    }

    public function isDisableAutoReminders(): bool
    {
        return $this->disableAutoReminders;
    }

    public function setDisableAutoReminders(bool $disableAutoReminders): void
    {
        $this->disableAutoReminders = $disableAutoReminders;
    }

    public function getBuyerId(): ?int
    {
        return $this->buyerId;
    }

    public function setBuyerId(?int $buyerId): void
    {
        $this->buyerId = $buyerId;
    }

    public function getPriceListId(): ?int
    {
        return $this->priceListId;
    }

    public function setPriceListId(?int $priceListId): void
    {
        $this->priceListId = $priceListId;
    }

    public function getSearchData(): ?string
    {
        return $this->searchData;
    }

    public function setSearchData(?string $searchData): void
    {
        $this->searchData = $searchData;
    }

    public function getPanelUrl(): ?string
    {
        return $this->panelUrl;
    }

    public function setPanelUrl(?string $panelUrl): void
    {
        $this->panelUrl = $panelUrl;
    }

    public function getUsePostalAddress(): ?bool
    {
        return $this->usePostalAddress;
    }

    public function setUsePostalAddress(?bool $usePostalAddress): void
    {
        $this->usePostalAddress = $usePostalAddress;
    }
}
