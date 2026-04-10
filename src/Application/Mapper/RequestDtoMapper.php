<?php

declare(strict_types=1);

namespace Codevenom\FakturowniaBundle\Application\Mapper;

use Codevenom\FakturowniaBundle\Application\Command\CreateClientCommand;
use Codevenom\FakturowniaBundle\Application\Command\CreateInvoiceCommand;
use Codevenom\FakturowniaBundle\Application\Query\GetInvoicePaymentStatusQuery;
use Codevenom\FakturowniaBundle\Application\Query\GetInvoiceQuery;
use Codevenom\FakturowniaBundle\Application\Query\ListClientsQuery;
use Codevenom\FakturowniaBundle\Application\Query\ListInvoicesQuery;

final class RequestDtoMapper
{
    public function mapListInvoicesQuery(ListInvoicesQuery $query): ListInvoicesQuery
    {
        return $query;
    }

    public function mapGetInvoiceQuery(GetInvoiceQuery $query): GetInvoiceQuery
    {
        return $query;
    }

    public function mapCreateInvoiceCommand(CreateInvoiceCommand $command): CreateInvoiceCommand
    {
        return $command;
    }

    public function mapListClientsQuery(ListClientsQuery $query): ListClientsQuery
    {
        return $query;
    }

    public function mapCreateClientCommand(CreateClientCommand $command): CreateClientCommand
    {
        return $command;
    }

    public function mapGetInvoicePaymentStatusQuery(GetInvoicePaymentStatusQuery $query): GetInvoicePaymentStatusQuery
    {
        return $query;
    }
}
