<?php

declare(strict_types=1);

namespace Codevenom\FakturowniaBundle\Mcp;

use Codevenom\FakturowniaBundle\Application\Command\CreateClientCommand;
use Codevenom\FakturowniaBundle\Application\Command\CreateInvoiceCommand;
use Codevenom\FakturowniaBundle\Application\Query\GetInvoicePaymentStatusQuery;
use Codevenom\FakturowniaBundle\Application\Query\GetInvoiceQuery;
use Codevenom\FakturowniaBundle\Application\Query\ListClientsQuery;
use Codevenom\FakturowniaBundle\Application\Query\ListInvoicesQuery;
use Codevenom\FakturowniaBundle\Domain\Contract\FakturowniaInterface;
use Codevenom\FakturowniaBundle\Domain\ValueObject\ClientId;
use Codevenom\FakturowniaBundle\Domain\ValueObject\InvoiceId;
use Codevenom\FakturowniaBundle\Domain\ValueObject\KeyValuePayload;
use Mcp\Capability\Attribute\McpTool;

final class FakturowniaMcpTools
{
    public function __construct(private readonly FakturowniaInterface $fakturownia)
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
        $result = $this->fakturownia->listInvoices(new ListInvoicesQuery(
            page: $page,
            perPage: $perPage,
            period: $period,
            includePositions: $includePositions,
            clientId: null !== $clientId ? ClientId::fromIntOrString($clientId) : null,
            number: $number,
            order: $order,
            income: $income,
            dateFrom: $dateFrom,
            dateTo: $dateTo,
            searchDateType: $searchDateType,
        ));

        return $result->toArray();
    }

    #[McpTool(name: 'get_invoice')]
    public function getInvoice(int|string $invoiceId, ?bool $includePositions = null): array
    {
        $result = $this->fakturownia->getInvoice(new GetInvoiceQuery(
            invoiceId: InvoiceId::fromIntOrString($invoiceId),
            includePositions: $includePositions,
        ));

        return $result->toArray();
    }

    #[McpTool(name: 'create_invoice')]
    public function createInvoice(array $invoice): array
    {
        $result = $this->fakturownia->createInvoice(
            new CreateInvoiceCommand(KeyValuePayload::fromArray($invoice)),
        );

        return $result->toArray();
    }

    #[McpTool(name: 'list_clients')]
    public function listClients(
        ?int $page = null,
        ?int $perPage = null,
        ?string $query = null,
        int|string|null $externalId = null,
    ): array {
        $result = $this->fakturownia->listClients(new ListClientsQuery(
            page: $page,
            perPage: $perPage,
            query: $query,
            externalId: null !== $externalId ? ClientId::fromIntOrString($externalId) : null,
        ));

        return $result->toArray();
    }

    #[McpTool(name: 'create_client')]
    public function createClient(array $client): array
    {
        $result = $this->fakturownia->createClient(
            new CreateClientCommand(KeyValuePayload::fromArray($client)),
        );

        return $result->toArray();
    }

    #[McpTool(name: 'invoice_payment_status')]
    public function invoicePaymentStatus(int|string $invoiceId): array
    {
        $result = $this->fakturownia->getInvoicePaymentStatus(
            new GetInvoicePaymentStatusQuery(InvoiceId::fromIntOrString($invoiceId)),
        );

        return $result->toArray();
    }
}
