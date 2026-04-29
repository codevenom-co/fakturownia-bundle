<?php

namespace Codevenom\FakturowniaBundle\Invoice\Enum;

enum InvoiceStatus: string
{
    case ISSUED = 'issued';
    case SENT = 'sent';
    case PAID = 'paid';
    case PARTIALLY_PAID = 'partial';
    case REJECTED = 'rejected';
}