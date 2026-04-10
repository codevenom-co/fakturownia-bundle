<?php

declare(strict_types=1);

namespace Codevenom\FakturowniaBundle\Mcp\Mapper;

use Codevenom\FakturowniaBundle\Application\DTO\ClientDto;
use Codevenom\FakturowniaBundle\Application\DTO\ClientListDto;
use Codevenom\FakturowniaBundle\Application\DTO\InvoiceDto;
use Codevenom\FakturowniaBundle\Application\DTO\InvoiceListDto;
use Codevenom\FakturowniaBundle\Application\DTO\PaymentStatusDto;

final class McpOutputMapper
{
    public function mapInvoiceList(InvoiceListDto $response): array
    {
        return $response->toArray();
    }

    public function mapInvoice(InvoiceDto $response): array
    {
        return $response->toArray();
    }

    public function mapClientList(ClientListDto $response): array
    {
        return $response->toArray();
    }

    public function mapClient(ClientDto $response): array
    {
        return $response->toArray();
    }

    public function mapPaymentStatus(PaymentStatusDto $response): array
    {
        return $response->toArray();
    }
}
