<?php

declare(strict_types=1);

namespace Codevenom\FakturowniaBundle\Application\Dto;

use Codevenom\FakturowniaBundle\Domain\Enum\DocumentType;
use Codevenom\FakturowniaBundle\Domain\ValueObject\InvoiceId;
use Codevenom\FakturowniaBundle\Domain\ValueObject\KeyValuePayload;

final readonly class Invoice
{
    public function __construct(
        public ?InvoiceId $id,
        public ?string $number,
        public ?string $currency,
        public DocumentType $documentType,
        public KeyValuePayload $payload,
    ) {
    }

    public function toArray(): array
    {
        return $this->payload->toArray();
    }
}
