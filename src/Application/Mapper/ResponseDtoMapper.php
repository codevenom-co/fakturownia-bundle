<?php

declare(strict_types=1);

namespace Codevenom\FakturowniaBundle\Application\Mapper;

use Codevenom\FakturowniaBundle\Application\DTO\ClientDto;
use Codevenom\FakturowniaBundle\Application\DTO\ClientListDto;
use Codevenom\FakturowniaBundle\Application\DTO\InvoiceDto;
use Codevenom\FakturowniaBundle\Application\DTO\InvoiceListDto;
use Codevenom\FakturowniaBundle\Application\DTO\PaymentStatusDto;

final class ResponseDtoMapper
{
    public function mapInvoiceList(InvoiceListDto $response): InvoiceListDto
    {
        return $response;
    }

    public function mapInvoice(InvoiceDto $response): InvoiceDto
    {
        return $response;
    }

    public function mapClientList(ClientListDto $response): ClientListDto
    {
        return $response;
    }

    public function mapClient(ClientDto $response): ClientDto
    {
        return $response;
    }

    public function mapPaymentStatus(PaymentStatusDto $response): PaymentStatusDto
    {
        return $response;
    }
}
