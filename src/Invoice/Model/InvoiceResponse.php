<?php

declare(strict_types=1);

namespace Codevenom\FakturowniaBundle\Invoice\Model;

class InvoiceResponse
{
    private function __construct(
        public int $id,
        public string $number,
        public string $url,
    ) {
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getNumber(): string
    {
        return $this->number;
    }

    public function setNumber(string $number): void
    {
        $this->number = $number;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function setUrl(string $url): void
    {
        $this->url = $url;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            id: $data['id'],
            number: $data['number'],
            url: $data['view_url']
        );
    }
}
