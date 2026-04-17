<?php

declare(strict_types=1);

namespace Codevenom\FakturowniaBundle\Infrastructure\MCP;

use Codevenom\FakturowniaBundle\Domain\Contract\FakturowniaInterface;
use Codevenom\FakturowniaBundle\Infrastructure\MCP\Mapper\McpInputMapper;
use Codevenom\FakturowniaBundle\Infrastructure\MCP\Mapper\McpOutputMapper;
use Mcp\Capability\Attribute\McpTool;

final class FakturowniaMcpTools
{
    public function __construct(
        private readonly FakturowniaInterface $fakturownia,
        private readonly McpInputMapper $inputMapper,
        private readonly McpOutputMapper $outputMapper,
    ) {
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
        $result = $this->fakturownia->listInvoices(
            $this->inputMapper->mapListInvoices(
                $page,
                $perPage,
                $period,
                $includePositions,
                $clientId,
                $number,
                $order,
                $income,
                $dateFrom,
                $dateTo,
                $searchDateType,
            ),
        );

        return $this->outputMapper->mapInvoiceList($result);
    }

    #[McpTool(name: 'get_invoice')]
    public function getInvoice(int|string $invoiceId, ?bool $includePositions = null): array
    {
        $result = $this->fakturownia->getInvoice(
            $this->inputMapper->mapGetInvoice($invoiceId, $includePositions),
        );

        return $this->outputMapper->mapInvoice($result);
    }

    #[McpTool(name: 'create_invoice')]
    public function createInvoice(array $invoice): array
    {
        $result = $this->fakturownia->createInvoice($this->inputMapper->mapCreateInvoice($invoice));

        return $this->outputMapper->mapInvoice($result);
    }

    #[McpTool(name: 'list_clients')]
    public function listClients(
        ?int $page = null,
        ?int $perPage = null,
        ?string $query = null,
        int|string|null $externalId = null,
    ): array {
        $result = $this->fakturownia->listClients(
            $this->inputMapper->mapListClients($page, $perPage, $query, $externalId),
        );

        return $this->outputMapper->mapClientList($result);
    }

    #[McpTool(name: 'create_client')]
    public function createClient(array $client): array
    {
        $result = $this->fakturownia->createClient($this->inputMapper->mapCreateClient($client));

        return $this->outputMapper->mapClient($result);
    }

    #[McpTool(name: 'invoice_payment_status')]
    public function invoicePaymentStatus(int|string $invoiceId): array
    {
        $result = $this->fakturownia->getInvoicePaymentStatus(
            $this->inputMapper->mapInvoicePaymentStatus($invoiceId),
        );

        return $this->outputMapper->mapPaymentStatus($result);
    }
}
