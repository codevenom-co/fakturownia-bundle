<?php

declare(strict_types=1);

namespace Codevenom\FakturowniaBundle\Application\Handler;

use Codevenom\FakturowniaBundle\Application\Dto\ClientList;
use Codevenom\FakturowniaBundle\Application\Mapper\RequestDtoMapper;
use Codevenom\FakturowniaBundle\Application\Mapper\ResponseDtoMapper;
use Codevenom\FakturowniaBundle\Application\Query\ListClientsQuery;
use Codevenom\FakturowniaBundle\Domain\Contract\Port\FakturowniaGatewayInterface;

final class ListClientsHandler
{
    public function __construct(
        private readonly FakturowniaGatewayInterface $gateway,
        private readonly RequestDtoMapper $requestMapper,
        private readonly ResponseDtoMapper $responseMapper,
    ) {
    }

    public function handle(ListClientsQuery $query): ClientList
    {
        $response = $this->gateway->listClients($this->requestMapper->mapListClientsQuery($query));

        return $this->responseMapper->mapClientList($response);
    }
}
