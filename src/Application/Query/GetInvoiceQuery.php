<?php

declare(strict_types=1);

namespace Codevenom\FakturowniaBundle\Application\Query;

use Codevenom\FakturowniaBundle\Domain\ValueObject\InvoiceId;

final readonly class GetInvoiceQuery
{
    public function __construct(
        public InvoiceId $invoiceId,
        public ?bool $includePositions = null,
    ) {
    }
}
