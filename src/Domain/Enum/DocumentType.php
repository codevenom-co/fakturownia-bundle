<?php

declare(strict_types=1);

namespace Codevenom\FakturowniaBundle\Domain\Enum;

enum DocumentType: string
{
    case INVOICE = 'invoice';
    case PROFORMA = 'proforma';
    case CORRECTION = 'correction';
    case RECEIPT = 'receipt';
    case UNKNOWN = 'unknown';

    public static function fromApiPayload(array $payload): self
    {
        foreach (['document_type', 'kind', 'type'] as $key) {
            $value = $payload[$key] ?? null;

            if (\is_string($value) && '' !== $value) {
                return self::tryFrom($value) ?? self::UNKNOWN;
            }
        }

        return self::UNKNOWN;
    }
}
