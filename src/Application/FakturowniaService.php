<?php

declare(strict_types=1);

namespace Codevenom\FakturowniaBundle\Application;

use Codevenom\FakturowniaBundle\Domain\Contract\FakturowniaInterface;
use Codevenom\FakturowniaBundle\Domain\Contract\Port\FakturowniaGatewayInterface;

final class FakturowniaService implements FakturowniaInterface
{
    public function __construct(private readonly FakturowniaGatewayInterface $gateway)
    {
    }

    public function listInvoices(array $filters = []): array
    {
        return $this->gateway->listInvoices($filters);
    }

    public function getInvoice(int|string $invoiceId, array $filters = []): array
    {
        return $this->gateway->getInvoice($invoiceId, $filters);
    }

    public function createInvoice(array $invoice): array
    {
        return $this->gateway->createInvoice($invoice);
    }

    public function listClients(array $filters = []): array
    {
        return $this->gateway->listClients($filters);
    }

    public function createClient(array $client): array
    {
        return $this->gateway->createClient($client);
    }

    public function invoicePaymentStatus(int|string $invoiceId): array
    {
        return $this->gateway->invoicePaymentStatus($invoiceId);
    }
}
