<?php

declare(strict_types=1);

namespace Codevenom\FakturowniaBundle\Infrastructure\FakturowniaApi\Adapter;

use Codevenom\FakturowniaBundle\Application\Command\CreateClientCommand;
use Codevenom\FakturowniaBundle\Application\Command\CreateInvoiceCommand;
use Codevenom\FakturowniaBundle\Application\Dto\Client;
use Codevenom\FakturowniaBundle\Application\Dto\ClientList;
use Codevenom\FakturowniaBundle\Application\Dto\Invoice;
use Codevenom\FakturowniaBundle\Application\Dto\InvoiceList;
use Codevenom\FakturowniaBundle\Application\Dto\PaymentStatus;
use Codevenom\FakturowniaBundle\Application\Query\GetInvoicePaymentStatusQuery;
use Codevenom\FakturowniaBundle\Application\Query\GetInvoiceQuery;
use Codevenom\FakturowniaBundle\Application\Query\ListClientsQuery;
use Codevenom\FakturowniaBundle\Application\Query\ListInvoicesQuery;
use Codevenom\FakturowniaBundle\Domain\Contract\Port\FakturowniaGatewayInterface;
use Codevenom\FakturowniaBundle\Infrastructure\FakturowniaApi\Http\FakturowniaClientInterface;
use Codevenom\FakturowniaBundle\Infrastructure\FakturowniaApi\Mapper\FakturowniaDtoMapper;

final class FakturowniaGatewayAdapter implements FakturowniaGatewayInterface
{
    public function __construct(
        private readonly FakturowniaClientInterface $client,
        private readonly FakturowniaDtoMapper $mapper,
    ) {
    }

    public function listInvoices(ListInvoicesQuery $query): InvoiceList
    {
        $response = $this->client->listInvoices($this->mapper->mapListInvoicesQueryToFilters($query));

        return $this->mapper->mapInvoiceList($response);
    }

    public function getInvoice(GetInvoiceQuery $query): Invoice
    {
        $response = $this->client->getInvoice(
            $query->invoiceId->value,
            $this->mapper->mapGetInvoiceQueryToFilters($query),
        );

        return $this->mapper->mapInvoice($response);
    }

    public function createInvoice(CreateInvoiceCommand $command): Invoice
    {
        $response = $this->client->createInvoice($command->invoice->toArray());

        return $this->mapper->mapInvoice($response);
    }

    public function listClients(ListClientsQuery $query): ClientList
    {
        $response = $this->client->listClients($this->mapper->mapListClientsQueryToFilters($query));

        return $this->mapper->mapClientList($response);
    }

    public function createClient(CreateClientCommand $command): Client
    {
        $response = $this->client->createClient($command->client->toArray());

        return $this->mapper->mapClient($response);
    }

    public function getInvoicePaymentStatus(GetInvoicePaymentStatusQuery $query): PaymentStatus
    {
        $response = $this->client->invoicePaymentStatus($query->invoiceId->value);

        return $this->mapper->mapPaymentStatus($response);
    }
}
