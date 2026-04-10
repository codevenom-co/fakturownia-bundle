<?php

declare(strict_types=1);

namespace Codevenom\FakturowniaBundle\Application\Handler;

use Codevenom\FakturowniaBundle\Application\Command\CreateInvoiceCommand;
use Codevenom\FakturowniaBundle\Application\DTO\InvoiceDto;
use Codevenom\FakturowniaBundle\Application\Mapper\RequestDtoMapper;
use Codevenom\FakturowniaBundle\Application\Mapper\ResponseDtoMapper;
use Codevenom\FakturowniaBundle\Domain\Contract\Port\FakturowniaGatewayInterface;
use Codevenom\FakturowniaBundle\Domain\Event\DomainEventDispatcherInterface;
use Codevenom\FakturowniaBundle\Domain\Event\InvoiceCreated;

final class CreateInvoiceHandler
{
    public function __construct(
        private readonly FakturowniaGatewayInterface $gateway,
        private readonly RequestDtoMapper $requestMapper,
        private readonly ResponseDtoMapper $responseMapper,
        private readonly DomainEventDispatcherInterface $eventDispatcher,
    ) {
    }

    public function handle(CreateInvoiceCommand $command): InvoiceDto
    {
        $response = $this->gateway->createInvoice($this->requestMapper->mapCreateInvoiceCommand($command));
        $invoice = $this->responseMapper->mapInvoice($response);
        $this->eventDispatcher->dispatch(new InvoiceCreated($invoice->payload));

        return $invoice;
    }
}
