<?php

declare(strict_types=1);

namespace Codevenom\FakturowniaBundle\Application\Handler;

use Codevenom\FakturowniaBundle\Application\Command\CreateClientCommand;
use Codevenom\FakturowniaBundle\Application\DTO\ClientDto;
use Codevenom\FakturowniaBundle\Application\Mapper\RequestDtoMapper;
use Codevenom\FakturowniaBundle\Application\Mapper\ResponseDtoMapper;
use Codevenom\FakturowniaBundle\Domain\Contract\Port\FakturowniaGatewayInterface;
use Codevenom\FakturowniaBundle\Domain\Event\ClientCreated;
use Codevenom\FakturowniaBundle\Domain\Event\DomainEventDispatcherInterface;

final class CreateClientHandler
{
    public function __construct(
        private readonly FakturowniaGatewayInterface $gateway,
        private readonly RequestDtoMapper $requestMapper,
        private readonly ResponseDtoMapper $responseMapper,
        private readonly DomainEventDispatcherInterface $eventDispatcher,
    ) {
    }

    public function handle(CreateClientCommand $command): ClientDto
    {
        $response = $this->gateway->createClient($this->requestMapper->mapCreateClientCommand($command));
        $client = $this->responseMapper->mapClient($response);
        $this->eventDispatcher->dispatch(new ClientCreated($client->payload));

        return $client;
    }
}
