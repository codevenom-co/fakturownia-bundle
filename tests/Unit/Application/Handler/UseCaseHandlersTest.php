<?php

declare(strict_types=1);

namespace Codevenom\FakturowniaBundle\Tests\Unit\Application\Handler;

use Codevenom\FakturowniaBundle\Application\Command\CreateClientCommand;
use Codevenom\FakturowniaBundle\Application\Command\CreateInvoiceCommand;
use Codevenom\FakturowniaBundle\Application\Dto\Client;
use Codevenom\FakturowniaBundle\Application\Dto\ClientList;
use Codevenom\FakturowniaBundle\Application\Dto\Invoice;
use Codevenom\FakturowniaBundle\Application\Dto\InvoiceList;
use Codevenom\FakturowniaBundle\Application\Dto\PaymentStatus;
use Codevenom\FakturowniaBundle\Application\Handler\CreateClientHandler;
use Codevenom\FakturowniaBundle\Application\Handler\CreateInvoiceHandler;
use Codevenom\FakturowniaBundle\Application\Handler\GetInvoiceHandler;
use Codevenom\FakturowniaBundle\Application\Handler\GetInvoicePaymentStatusHandler;
use Codevenom\FakturowniaBundle\Application\Handler\ListClientsHandler;
use Codevenom\FakturowniaBundle\Application\Handler\ListInvoicesHandler;
use Codevenom\FakturowniaBundle\Application\Mapper\RequestDtoMapper;
use Codevenom\FakturowniaBundle\Application\Mapper\ResponseDtoMapper;
use Codevenom\FakturowniaBundle\Application\Query\GetInvoicePaymentStatusQuery;
use Codevenom\FakturowniaBundle\Application\Query\GetInvoiceQuery;
use Codevenom\FakturowniaBundle\Application\Query\ListClientsQuery;
use Codevenom\FakturowniaBundle\Application\Query\ListInvoicesQuery;
use Codevenom\FakturowniaBundle\Domain\Contract\Port\FakturowniaGatewayInterface;
use Codevenom\FakturowniaBundle\Domain\Event\ClientCreated;
use Codevenom\FakturowniaBundle\Domain\Event\InvoiceCreated;
use Codevenom\FakturowniaBundle\Domain\Event\InvoicePaymentStatusChecked;
use Codevenom\FakturowniaBundle\Domain\Enum\DocumentType;
use Codevenom\FakturowniaBundle\Domain\Enum\PaymentState;
use Codevenom\FakturowniaBundle\Domain\ValueObject\ClientId;
use Codevenom\FakturowniaBundle\Domain\ValueObject\InvoiceId;
use Codevenom\FakturowniaBundle\Domain\ValueObject\KeyValuePayload;
use Codevenom\FakturowniaBundle\Domain\ValueObject\Money;
use Codevenom\FakturowniaBundle\Infrastructure\FakturowniaApi\Event\InMemoryDomainEventDispatcher;
use PHPUnit\Framework\TestCase;

final class UseCaseHandlersTest extends TestCase
{
    public function testListInvoicesHandlerDelegatesAndReturnsResponse(): void
    {
        $gateway = new RecordingGateway();
        $expected = new InvoiceList([], KeyValuePayload::fromArray(['invoices' => []]));
        $gateway->listInvoicesResponse = $expected;
        $handler = new ListInvoicesHandler($gateway, new RequestDtoMapper(), new ResponseDtoMapper());
        $query = new ListInvoicesQuery(page: 2, perPage: 10, period: 'last_month');

        self::assertSame($expected, $handler->handle($query));
        self::assertSame($query, $gateway->listInvoicesQuery);
    }

    public function testGetInvoiceHandlerDelegatesAndReturnsResponse(): void
    {
        $gateway = new RecordingGateway();
        $expected = new Invoice(
            InvoiceId::fromIntOrString('42'),
            'FV/42',
            'PLN',
            DocumentType::INVOICE,
            KeyValuePayload::fromArray(['id' => 42]),
        );
        $gateway->getInvoiceResponse = $expected;
        $handler = new GetInvoiceHandler($gateway, new RequestDtoMapper(), new ResponseDtoMapper());
        $query = new GetInvoiceQuery(InvoiceId::fromIntOrString(42), true);

        self::assertSame($expected, $handler->handle($query));
        self::assertSame($query, $gateway->getInvoiceQuery);
    }

    public function testCreateInvoiceHandlerDelegatesAndReturnsResponse(): void
    {
        $gateway = new RecordingGateway();
        $events = new InMemoryDomainEventDispatcher();
        $expected = new Invoice(
            InvoiceId::fromIntOrString('100'),
            'FV/100',
            'PLN',
            DocumentType::INVOICE,
            KeyValuePayload::fromArray(['id' => 100]),
        );
        $gateway->createInvoiceResponse = $expected;
        $handler = new CreateInvoiceHandler($gateway, new RequestDtoMapper(), new ResponseDtoMapper(), $events);
        $command = new CreateInvoiceCommand(KeyValuePayload::fromArray(['number' => 'FV/100']));

        self::assertSame($expected, $handler->handle($command));
        self::assertSame($command, $gateway->createInvoiceCommand);
        self::assertCount(1, $events->events());
        self::assertInstanceOf(InvoiceCreated::class, $events->events()[0]);
    }

    public function testListClientsHandlerDelegatesAndReturnsResponse(): void
    {
        $gateway = new RecordingGateway();
        $expected = new ClientList([], KeyValuePayload::fromArray(['clients' => []]));
        $gateway->listClientsResponse = $expected;
        $handler = new ListClientsHandler($gateway, new RequestDtoMapper(), new ResponseDtoMapper());
        $query = new ListClientsQuery(page: 1, perPage: 25, query: 'acme');

        self::assertSame($expected, $handler->handle($query));
        self::assertSame($query, $gateway->listClientsQuery);
    }

    public function testCreateClientHandlerDelegatesAndReturnsResponse(): void
    {
        $gateway = new RecordingGateway();
        $events = new InMemoryDomainEventDispatcher();
        $expected = new Client(
            ClientId::fromIntOrString('7'),
            'Acme',
            KeyValuePayload::fromArray(['id' => 7]),
        );
        $gateway->createClientResponse = $expected;
        $handler = new CreateClientHandler($gateway, new RequestDtoMapper(), new ResponseDtoMapper(), $events);
        $command = new CreateClientCommand(KeyValuePayload::fromArray(['name' => 'Acme']));

        self::assertSame($expected, $handler->handle($command));
        self::assertSame($command, $gateway->createClientCommand);
        self::assertCount(1, $events->events());
        self::assertInstanceOf(ClientCreated::class, $events->events()[0]);
    }

    public function testGetInvoicePaymentStatusHandlerDelegatesAndReturnsResponse(): void
    {
        $gateway = new RecordingGateway();
        $events = new InMemoryDomainEventDispatcher();
        $expected = new PaymentStatus(
            InvoiceId::fromIntOrString('9'),
            'FV/9',
            'PLN',
            new Money(100.0, 'PLN'),
            new Money(0.0, 'PLN'),
            true,
            'bank_transfer',
            '2026-04-11',
            PaymentState::PAID,
            1,
            KeyValuePayload::fromArray(['payment_state' => 'paid']),
        );
        $gateway->getInvoicePaymentStatusResponse = $expected;
        $handler = new GetInvoicePaymentStatusHandler($gateway, new RequestDtoMapper(), new ResponseDtoMapper(), $events);
        $query = new GetInvoicePaymentStatusQuery(InvoiceId::fromIntOrString(9));

        self::assertSame($expected, $handler->handle($query));
        self::assertSame($query, $gateway->getInvoicePaymentStatusQuery);
        self::assertCount(1, $events->events());
        self::assertInstanceOf(InvoicePaymentStatusChecked::class, $events->events()[0]);
    }
}

final class RecordingGateway implements FakturowniaGatewayInterface
{
    public ?ListInvoicesQuery $listInvoicesQuery = null;

    public ?GetInvoiceQuery $getInvoiceQuery = null;

    public ?CreateInvoiceCommand $createInvoiceCommand = null;

    public ?ListClientsQuery $listClientsQuery = null;

    public ?CreateClientCommand $createClientCommand = null;

    public ?GetInvoicePaymentStatusQuery $getInvoicePaymentStatusQuery = null;

    public InvoiceList $listInvoicesResponse;

    public Invoice $getInvoiceResponse;

    public Invoice $createInvoiceResponse;

    public ClientList $listClientsResponse;

    public Client $createClientResponse;

    public PaymentStatus $getInvoicePaymentStatusResponse;

    public function listInvoices(ListInvoicesQuery $query): InvoiceList
    {
        $this->listInvoicesQuery = $query;

        return $this->listInvoicesResponse;
    }

    public function getInvoice(GetInvoiceQuery $query): Invoice
    {
        $this->getInvoiceQuery = $query;

        return $this->getInvoiceResponse;
    }

    public function createInvoice(CreateInvoiceCommand $command): Invoice
    {
        $this->createInvoiceCommand = $command;

        return $this->createInvoiceResponse;
    }

    public function listClients(ListClientsQuery $query): ClientList
    {
        $this->listClientsQuery = $query;

        return $this->listClientsResponse;
    }

    public function createClient(CreateClientCommand $command): Client
    {
        $this->createClientCommand = $command;

        return $this->createClientResponse;
    }

    public function getInvoicePaymentStatus(GetInvoicePaymentStatusQuery $query): PaymentStatus
    {
        $this->getInvoicePaymentStatusQuery = $query;

        return $this->getInvoicePaymentStatusResponse;
    }
}
