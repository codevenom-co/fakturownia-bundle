<?php

declare(strict_types=1);

namespace Codevenom\FakturowniaBundle\Application\Mapper;

use Codevenom\FakturowniaBundle\Application\Dto\Client;
use Codevenom\FakturowniaBundle\Application\Dto\ClientList;
use Codevenom\FakturowniaBundle\Application\Dto\Invoice;
use Codevenom\FakturowniaBundle\Application\Dto\InvoiceList;
use Codevenom\FakturowniaBundle\Application\Dto\PaymentStatus;

final class ResponseDtoMapper
{
    public function mapInvoiceList(InvoiceList $response): InvoiceList
    {
        return $response;
    }

    public function mapInvoice(Invoice $response): Invoice
    {
        return $response;
    }

    public function mapClientList(ClientList $response): ClientList
    {
        return $response;
    }

    public function mapClient(Client $response): Client
    {
        return $response;
    }

    public function mapPaymentStatus(PaymentStatus $response): PaymentStatus
    {
        return $response;
    }
}
