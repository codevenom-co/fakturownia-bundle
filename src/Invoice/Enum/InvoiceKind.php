<?php

namespace Codevenom\FakturowniaBundle\Invoice\Enum;

enum InvoiceKind: string
{
    case ACCOUNTING_NOTE = 'accounting_note';
    case VAT = 'vat';
    case PRO_FORMA = 'proforma';
}
