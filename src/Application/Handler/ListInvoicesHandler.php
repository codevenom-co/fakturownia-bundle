<?php

declare(strict_types=1);

namespace Codevenom\FakturowniaBundle\Application\Handler;

use Codevenom\FakturowniaBundle\Application\Dto\InvoiceList;
use Codevenom\FakturowniaBundle\Application\Mapper\RequestDtoMapper;
use Codevenom\FakturowniaBundle\Application\Mapper\ResponseDtoMapper;
use Codevenom\FakturowniaBundle\Application\Query\ListInvoicesQuery;
use Codevenom\FakturowniaBundle\Domain\Contract\Port\FakturowniaGatewayInterface;

final class ListInvoicesHandler
{
    public function __construct(
        private readonly FakturowniaGatewayInterface $gateway,
        private readonly RequestDtoMapper $requestMapper,
        private readonly ResponseDtoMapper $responseMapper,
    ) {
    }

    public function handle(ListInvoicesQuery $query): InvoiceList
    {
        $response = $this->gateway->listInvoices($this->requestMapper->mapListInvoicesQuery($query));

        return $this->responseMapper->mapInvoiceList($response);
    }
}
