<?php

namespace Codevenom\FakturowniaBundle\Invoice\Enum;

enum InvoicePeriod: string
{
    case LAST_MONTH = 'last_month';
    case LAST_12_MONTHS = 'last_12_months';
    case THIS_YEAR = 'this_year';
    case ALL = 'all';
}