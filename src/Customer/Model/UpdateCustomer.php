<?php

namespace Codevenom\FakturowniaBundle\Customer\Model;

use Symfony\Component\Serializer\Annotation\SerializedName;

class UpdateCustomer
{
    private ?string $name = null;

    #[SerializedName('tax_no')]
    private ?string $taxNo = null;

    private ?string $bank = null;

    #[SerializedName('bank_account')]
    private ?string $bankAccount = null;

    private ?string $city = null;

    private ?string $country = null;

    private ?string $email = null;

    private ?string $person = null;

    #[SerializedName('post_code')]
    private ?string $postCode = null;

    private ?string $phone = null;

    private ?string $street = null;

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

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(?string $city): void
    {
        $this->city = $city;
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

    public function getPerson(): ?string
    {
        return $this->person;
    }

    public function setPerson(?string $person): void
    {
        $this->person = $person;
    }

    public function getPostCode(): ?string
    {
        return $this->postCode;
    }

    public function setPostCode(?string $postCode): void
    {
        $this->postCode = $postCode;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): void
    {
        $this->phone = $phone;
    }

    public function getStreet(): ?string
    {
        return $this->street;
    }

    public function setStreet(?string $street): void
    {
        $this->street = $street;
    }
}
