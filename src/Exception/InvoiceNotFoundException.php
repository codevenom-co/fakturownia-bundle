<?php

namespace Codevenom\FakturowniaBundle\Exception;

class InvoiceNotFoundException extends FakturowniaException
{

    public static function withId(string $id): self
    {
        return new self(sprintf('Invoice with id %s not found', $id));
    }

    public static function withNumber(string $number): self
    {
        return new self(sprintf('Invoice with number %s not found', $number));
    }
}