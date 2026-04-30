<?php

namespace Codevenom\FakturowniaBundle\Exception;

use Codevenom\FakturowniaBundle\Invoice\Enum\InvoicePeriod;

class UnableToRetrieveInvoicesForProvidedPeriodException extends FakturowniaException
{
    public static function withPeriod(InvoicePeriod $period): self
    {
        return new self(sprintf('Unable to retrieve invoices for provided period: %s', $period->value));
    }
}