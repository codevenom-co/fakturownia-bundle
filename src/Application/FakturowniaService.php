<?php

declare(strict_types=1);

namespace Codevenom\FakturowniaBundle\Application;

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
use Codevenom\FakturowniaBundle\Domain\Contract\FakturowniaInterface;
use Codevenom\FakturowniaBundle\Domain\Contract\Port\FakturowniaGatewayInterface;

final class FakturowniaService implements FakturowniaInterface
{
    public function __construct(private readonly FakturowniaGatewayInterface $gateway)
    {
    }

    public function listInvoices(ListInvoicesQuery $query): InvoiceListDto
    {
        return $this->gateway->listInvoices($query);
    }

    public function getInvoice(GetInvoiceQuery $query): InvoiceDto
    {
        return $this->gateway->getInvoice($query);
    }

    public function createInvoice(CreateInvoiceCommand $command): InvoiceDto
    {
        return $this->gateway->createInvoice($command);
    }

    public function listClients(ListClientsQuery $query): ClientListDto
    {
        return $this->gateway->listClients($query);
    }

    public function createClient(CreateClientCommand $command): ClientDto
    {
        return $this->gateway->createClient($command);
    }

    public function getInvoicePaymentStatus(GetInvoicePaymentStatusQuery $query): PaymentStatusDto
    {
        return $this->gateway->getInvoicePaymentStatus($query);
    }
}
