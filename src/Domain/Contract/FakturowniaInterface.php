<?php

declare(strict_types=1);

namespace Codevenom\FakturowniaBundle\Domain\Contract;

interface FakturowniaInterface
{
    public function listInvoices(array $filters = []): array;

    public function getInvoice(int|string $invoiceId, array $filters = []): array;

    public function createInvoice(array $invoice): array;

    public function listClients(array $filters = []): array;

    public function createClient(array $client): array;

    public function invoicePaymentStatus(int|string $invoiceId): array;
}
