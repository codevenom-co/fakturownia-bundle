<?php

declare(strict_types=1);

namespace Codevenom\FakturowniaBundle\Mcp;

use Codevenom\FakturowniaBundle\Http\FakturowniaClient;
use Mcp\Capability\Attribute\McpTool;

final class FakturowniaMcpTools
{
    public function __construct(private readonly FakturowniaClient $client)
    {
    }

    #[McpTool(name: 'list_invoices')]
    public function listInvoices(
        ?int $page = null,
        ?int $perPage = null,
        ?string $period = null,
        ?bool $includePositions = null,
        int|string|null $clientId = null,
        ?string $number = null,
        ?string $order = null,
        ?string $income = null,
        ?string $dateFrom = null,
        ?string $dateTo = null,
        ?string $searchDateType = null,
    ): array {
        return $this->client->listInvoices(array_filter([
            'page' => $page,
            'per_page' => $perPage,
            'period' => $period,
            'include_positions' => $includePositions,
            'client_id' => $clientId,
            'number' => $number,
            'order' => $order,
            'income' => $income,
            'date_from' => $dateFrom,
            'date_to' => $dateTo,
            'search_date_type' => $searchDateType,
        ], static fn (mixed $value): bool => null !== $value));
    }

    #[McpTool(name: 'get_invoice')]
    public function getInvoice(int|string $invoiceId, ?bool $includePositions = null): array
    {
        $filters = [];

        if (null !== $includePositions) {
            $filters['include_positions'] = $includePositions;
        }

        return $this->client->getInvoice($invoiceId, $filters);
    }

    #[McpTool(name: 'create_invoice')]
    public function createInvoice(array $invoice): array
    {
        return $this->client->createInvoice($invoice);
    }

    #[McpTool(name: 'list_clients')]
    public function listClients(
        ?int $page = null,
        ?int $perPage = null,
        ?string $query = null,
        int|string|null $externalId = null,
    ): array {
        return $this->client->listClients(array_filter([
            'page' => $page,
            'per_page' => $perPage,
            'query' => $query,
            'external_id' => $externalId,
        ], static fn (mixed $value): bool => null !== $value));
    }

    #[McpTool(name: 'create_client')]
    public function createClient(array $client): array
    {
        return $this->client->createClient($client);
    }

    #[McpTool(name: 'invoice_payment_status')]
    public function invoicePaymentStatus(int|string $invoiceId): array
    {
        return $this->client->invoicePaymentStatus($invoiceId);
    }
}
