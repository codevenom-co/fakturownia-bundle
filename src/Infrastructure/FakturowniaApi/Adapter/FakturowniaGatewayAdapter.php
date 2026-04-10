<?php

declare(strict_types=1);

namespace Codevenom\FakturowniaBundle\Infrastructure\FakturowniaApi\Adapter;

use Codevenom\FakturowniaBundle\Domain\Contract\Port\FakturowniaGatewayInterface;
use Codevenom\FakturowniaBundle\Http\FakturowniaClient;

final class FakturowniaGatewayAdapter implements FakturowniaGatewayInterface
{
    public function __construct(private readonly FakturowniaClient $client)
    {
    }

    public function listInvoices(array $filters = []): array
    {
        return $this->client->listInvoices($filters);
    }

    public function getInvoice(int|string $invoiceId, array $filters = []): array
    {
        return $this->client->getInvoice($invoiceId, $filters);
    }

    public function createInvoice(array $invoice): array
    {
        return $this->client->createInvoice($invoice);
    }

    public function listClients(array $filters = []): array
    {
        return $this->client->listClients($filters);
    }

    public function createClient(array $client): array
    {
        return $this->client->createClient($client);
    }

    public function invoicePaymentStatus(int|string $invoiceId): array
    {
        return $this->client->invoicePaymentStatus($invoiceId);
    }
}
