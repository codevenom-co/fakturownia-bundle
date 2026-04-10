<?php

declare(strict_types=1);

namespace Codevenom\FakturowniaBundle\Tests\Unit\Domain\Enum;

use Codevenom\FakturowniaBundle\Domain\Enum\DocumentType;
use PHPUnit\Framework\TestCase;

final class DocumentTypeTest extends TestCase
{
    public function testItMapsDocumentTypeFromDocumentTypeKey(): void
    {
        self::assertSame(DocumentType::INVOICE, DocumentType::fromApiPayload(['document_type' => 'invoice']));
    }

    public function testItMapsDocumentTypeFromKindKey(): void
    {
        self::assertSame(DocumentType::PROFORMA, DocumentType::fromApiPayload(['kind' => 'proforma']));
    }

    public function testItMapsDocumentTypeFromTypeKey(): void
    {
        self::assertSame(DocumentType::CORRECTION, DocumentType::fromApiPayload(['type' => 'correction']));
    }

    public function testItFallsBackToUnknownForMissingValue(): void
    {
        self::assertSame(DocumentType::UNKNOWN, DocumentType::fromApiPayload([]));
    }
}
