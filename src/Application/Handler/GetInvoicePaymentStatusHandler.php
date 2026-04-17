<?php

declare(strict_types=1);

namespace Codevenom\FakturowniaBundle\Application\Handler;

use Codevenom\FakturowniaBundle\Application\Dto\PaymentStatus;
use Codevenom\FakturowniaBundle\Application\Mapper\RequestDtoMapper;
use Codevenom\FakturowniaBundle\Application\Mapper\ResponseDtoMapper;
use Codevenom\FakturowniaBundle\Application\Query\GetInvoicePaymentStatusQuery;
use Codevenom\FakturowniaBundle\Domain\Contract\Port\FakturowniaGatewayInterface;
use Codevenom\FakturowniaBundle\Domain\Event\DomainEventDispatcherInterface;
use Codevenom\FakturowniaBundle\Domain\Event\InvoicePaymentStatusChecked;

final class GetInvoicePaymentStatusHandler
{
    public function __construct(
        private readonly FakturowniaGatewayInterface $gateway,
        private readonly RequestDtoMapper $requestMapper,
        private readonly ResponseDtoMapper $responseMapper,
        private readonly DomainEventDispatcherInterface $eventDispatcher,
    ) {
    }

    public function handle(GetInvoicePaymentStatusQuery $query): PaymentStatus
    {
        $response = $this->gateway->getInvoicePaymentStatus(
            $this->requestMapper->mapGetInvoicePaymentStatusQuery($query),
        );
        $paymentStatus = $this->responseMapper->mapPaymentStatus($response);
        $this->eventDispatcher->dispatch(new InvoicePaymentStatusChecked($paymentStatus->payload));

        return $paymentStatus;
    }
}
