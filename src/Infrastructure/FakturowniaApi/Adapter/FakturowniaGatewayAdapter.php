<?php

declare(strict_types=1);

namespace Codevenom\FakturowniaBundle\Infrastructure\FakturowniaApi\Adapter;

use Codevenom\FakturowniaBundle\Application\Command\CreateClientCommand;
use Codevenom\FakturowniaBundle\Application\Command\CreateInvoiceCommand;
use Codevenom\FakturowniaBundle\Application\DTO\ClientDto;
use Codevenom\FakturowniaBundle\Application\DTO\ClientListDto;
use Codevenom\FakturowniaBundle\Application\DTO\InvoiceDto;
use Codevenom\FakturowniaBundle\Application\DTO\InvoiceListDto;
use Codevenom\FakturowniaBundle\Application\DTO\PaymentStatusDto;
use Codevenom\FakturowniaBundle\Application\Query\GetInvoicePaymentStatusQuery;
use Codevenom\FakturowniaBundle\Application\Query\GetInvoiceQuery;
use Codevenom\FakturowniaBundle\Application\Query\ListClientsQuery;
use Codevenom\FakturowniaBundle\Application\Query\ListInvoicesQuery;
use Codevenom\FakturowniaBundle\Domain\Contract\Port\FakturowniaGatewayInterface;
use Codevenom\FakturowniaBundle\Http\FakturowniaClient;
use Codevenom\FakturowniaBundle\Infrastructure\FakturowniaApi\Mapper\FakturowniaDtoMapper;

final class FakturowniaGatewayAdapter implements FakturowniaGatewayInterface
{
    public function __construct(
        private readonly FakturowniaClient $client,
        private readonly FakturowniaDtoMapper $mapper,
    )
    {
    }

    public function listInvoices(ListInvoicesQuery $query): InvoiceListDto
    {
        $response = $this->client->listInvoices($this->mapper->mapListInvoicesQueryToFilters($query));

        return $this->mapper->mapInvoiceList($response);
    }

    public function getInvoice(GetInvoiceQuery $query): InvoiceDto
    {
        $response = $this->client->getInvoice(
            $query->invoiceId->value,
            $this->mapper->mapGetInvoiceQueryToFilters($query),
        );

        return $this->mapper->mapInvoice($response);
    }

    public function createInvoice(CreateInvoiceCommand $command): InvoiceDto
    {
        $response = $this->client->createInvoice($command->invoice->toArray());

        return $this->mapper->mapInvoice($response);
    }

    public function listClients(ListClientsQuery $query): ClientListDto
    {
        $response = $this->client->listClients($this->mapper->mapListClientsQueryToFilters($query));

        return $this->mapper->mapClientList($response);
    }

    public function createClient(CreateClientCommand $command): ClientDto
    {
        $response = $this->client->createClient($command->client->toArray());

        return $this->mapper->mapClient($response);
    }

    public function getInvoicePaymentStatus(GetInvoicePaymentStatusQuery $query): PaymentStatusDto
    {
        $response = $this->client->invoicePaymentStatus($query->invoiceId->value);

        return $this->mapper->mapPaymentStatus($response);
    }
}
