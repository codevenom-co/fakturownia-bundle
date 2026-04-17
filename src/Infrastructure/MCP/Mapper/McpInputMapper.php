<?php

declare(strict_types=1);

namespace Codevenom\FakturowniaBundle\Infrastructure\MCP\Mapper;

use Codevenom\FakturowniaBundle\Application\Command\CreateClientCommand;
use Codevenom\FakturowniaBundle\Application\Command\CreateInvoiceCommand;
use Codevenom\FakturowniaBundle\Application\Query\GetInvoicePaymentStatusQuery;
use Codevenom\FakturowniaBundle\Application\Query\GetInvoiceQuery;
use Codevenom\FakturowniaBundle\Application\Query\ListClientsQuery;
use Codevenom\FakturowniaBundle\Application\Query\ListInvoicesQuery;
use Codevenom\FakturowniaBundle\Domain\ValueObject\ClientId;
use Codevenom\FakturowniaBundle\Domain\ValueObject\InvoiceId;
use Codevenom\FakturowniaBundle\Domain\ValueObject\KeyValuePayload;

final class McpInputMapper
{
    public function mapListInvoices(
        ?int $page,
        ?int $perPage,
        ?string $period,
        ?bool $includePositions,
        int|string|null $clientId,
        ?string $number,
        ?string $order,
        ?string $income,
        ?string $dateFrom,
        ?string $dateTo,
        ?string $searchDateType,
    ): ListInvoicesQuery {
        return new ListInvoicesQuery(
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
        );
    }

    public function mapGetInvoice(int|string $invoiceId, ?bool $includePositions): GetInvoiceQuery
    {
        return new GetInvoiceQuery(
            invoiceId: InvoiceId::fromIntOrString($invoiceId),
            includePositions: $includePositions,
        );
    }

    public function mapCreateInvoice(array $invoice): CreateInvoiceCommand
    {
        return new CreateInvoiceCommand(KeyValuePayload::fromArray($invoice));
    }

    public function mapListClients(
        ?int $page,
        ?int $perPage,
        ?string $query,
        int|string|null $externalId,
    ): ListClientsQuery {
        return new ListClientsQuery(
            page: $page,
            perPage: $perPage,
            query: $query,
            externalId: null !== $externalId ? ClientId::fromIntOrString($externalId) : null,
        );
    }

    public function mapCreateClient(array $client): CreateClientCommand
    {
        return new CreateClientCommand(KeyValuePayload::fromArray($client));
    }

    public function mapInvoicePaymentStatus(int|string $invoiceId): GetInvoicePaymentStatusQuery
    {
        return new GetInvoicePaymentStatusQuery(InvoiceId::fromIntOrString($invoiceId));
    }
}
