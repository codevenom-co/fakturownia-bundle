<?php

declare(strict_types=1);

namespace Codevenom\FakturowniaBundle\Domain\Contract;

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

interface FakturowniaInterface
{
    public function listInvoices(ListInvoicesQuery $query): InvoiceList;

    public function getInvoice(GetInvoiceQuery $query): Invoice;

    public function createInvoice(CreateInvoiceCommand $command): Invoice;

    public function listClients(ListClientsQuery $query): ClientList;

    public function createClient(CreateClientCommand $command): Client;

    public function getInvoicePaymentStatus(GetInvoicePaymentStatusQuery $query): PaymentStatus;
}
