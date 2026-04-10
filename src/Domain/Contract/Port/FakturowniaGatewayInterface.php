<?php

declare(strict_types=1);

namespace Codevenom\FakturowniaBundle\Domain\Contract\Port;

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

interface FakturowniaGatewayInterface
{
    public function listInvoices(ListInvoicesQuery $query): InvoiceListDto;

    public function getInvoice(GetInvoiceQuery $query): InvoiceDto;

    public function createInvoice(CreateInvoiceCommand $command): InvoiceDto;

    public function listClients(ListClientsQuery $query): ClientListDto;

    public function createClient(CreateClientCommand $command): ClientDto;

    public function getInvoicePaymentStatus(GetInvoicePaymentStatusQuery $query): PaymentStatusDto;
}
