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
use Codevenom\FakturowniaBundle\Application\Handler\CreateClientHandler;
use Codevenom\FakturowniaBundle\Application\Handler\CreateInvoiceHandler;
use Codevenom\FakturowniaBundle\Application\Handler\GetInvoiceHandler;
use Codevenom\FakturowniaBundle\Application\Handler\GetInvoicePaymentStatusHandler;
use Codevenom\FakturowniaBundle\Application\Handler\ListClientsHandler;
use Codevenom\FakturowniaBundle\Application\Handler\ListInvoicesHandler;
use Codevenom\FakturowniaBundle\Application\Query\GetInvoicePaymentStatusQuery;
use Codevenom\FakturowniaBundle\Application\Query\GetInvoiceQuery;
use Codevenom\FakturowniaBundle\Application\Query\ListClientsQuery;
use Codevenom\FakturowniaBundle\Application\Query\ListInvoicesQuery;
use Codevenom\FakturowniaBundle\Domain\Contract\FakturowniaInterface;

final class FakturowniaService implements FakturowniaInterface
{
    public function __construct(
        private readonly ListInvoicesHandler $listInvoicesHandler,
        private readonly GetInvoiceHandler $getInvoiceHandler,
        private readonly CreateInvoiceHandler $createInvoiceHandler,
        private readonly ListClientsHandler $listClientsHandler,
        private readonly CreateClientHandler $createClientHandler,
        private readonly GetInvoicePaymentStatusHandler $getInvoicePaymentStatusHandler,
    )
    {
    }

    public function listInvoices(ListInvoicesQuery $query): InvoiceListDto
    {
        return $this->listInvoicesHandler->handle($query);
    }

    public function getInvoice(GetInvoiceQuery $query): InvoiceDto
    {
        return $this->getInvoiceHandler->handle($query);
    }

    public function createInvoice(CreateInvoiceCommand $command): InvoiceDto
    {
        return $this->createInvoiceHandler->handle($command);
    }

    public function listClients(ListClientsQuery $query): ClientListDto
    {
        return $this->listClientsHandler->handle($query);
    }

    public function createClient(CreateClientCommand $command): ClientDto
    {
        return $this->createClientHandler->handle($command);
    }

    public function getInvoicePaymentStatus(GetInvoicePaymentStatusQuery $query): PaymentStatusDto
    {
        return $this->getInvoicePaymentStatusHandler->handle($query);
    }
}
