<?php

declare(strict_types=1);

namespace Codevenom\FakturowniaBundle\Infrastructure\MCP\Mapper;

use Codevenom\FakturowniaBundle\Application\Dto\Client;
use Codevenom\FakturowniaBundle\Application\Dto\ClientList;
use Codevenom\FakturowniaBundle\Application\Dto\Invoice;
use Codevenom\FakturowniaBundle\Application\Dto\InvoiceList;
use Codevenom\FakturowniaBundle\Application\Dto\PaymentStatus;

final class McpOutputMapper
{
    public function mapInvoiceList(InvoiceList $response): array
    {
        return $response->toArray();
    }

    public function mapInvoice(Invoice $response): array
    {
        return $response->toArray();
    }

    public function mapClientList(ClientList $response): array
    {
        return $response->toArray();
    }

    public function mapClient(Client $response): array
    {
        return $response->toArray();
    }

    public function mapPaymentStatus(PaymentStatus $response): array
    {
        return $response->toArray();
    }
}
