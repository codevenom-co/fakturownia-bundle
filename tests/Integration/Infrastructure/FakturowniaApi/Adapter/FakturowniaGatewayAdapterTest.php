<?php

declare(strict_types=1);

namespace Codevenom\FakturowniaBundle\Tests\Integration\Infrastructure\FakturowniaApi\Adapter;

use Codevenom\FakturowniaBundle\Application\Command\CreateClientCommand;
use Codevenom\FakturowniaBundle\Application\Command\CreateInvoiceCommand;
use Codevenom\FakturowniaBundle\Application\Query\GetInvoicePaymentStatusQuery;
use Codevenom\FakturowniaBundle\Application\Query\GetInvoiceQuery;
use Codevenom\FakturowniaBundle\Application\Query\ListClientsQuery;
use Codevenom\FakturowniaBundle\Application\Query\ListInvoicesQuery;
use Codevenom\FakturowniaBundle\Domain\Enum\DocumentType;
use Codevenom\FakturowniaBundle\Domain\Enum\PaymentState;
use Codevenom\FakturowniaBundle\Domain\Strategy\PaymentStateResolver;
use Codevenom\FakturowniaBundle\Domain\ValueObject\ClientId;
use Codevenom\FakturowniaBundle\Domain\ValueObject\InvoiceId;
use Codevenom\FakturowniaBundle\Domain\ValueObject\KeyValuePayload;
use Codevenom\FakturowniaBundle\Domain\ValueObject\Money;
use Codevenom\FakturowniaBundle\Infrastructure\FakturowniaApi\Adapter\FakturowniaGatewayAdapter;
use Codevenom\FakturowniaBundle\Infrastructure\FakturowniaApi\Http\FakturowniaClientInterface;
use Codevenom\FakturowniaBundle\Infrastructure\FakturowniaApi\Mapper\FakturowniaDtoMapper;
use PHPUnit\Framework\TestCase;

final class FakturowniaGatewayAdapterTest extends TestCase
{
    public function testListInvoicesMapsFixturePayloadToDto(): void
    {
        $client = new FixtureClient();
        $client->listInvoicesResponse = [
            'invoices' => [
                [
                    'id' => 1,
                    'number' => 'FV/1',
                    'currency' => 'PLN',
                    'document_type' => 'invoice',
                ],
            ],
        ];
        $adapter = $this->createAdapter($client);

        $result = $adapter->listInvoices(new ListInvoicesQuery(page: 1));

        self::assertCount(1, $result->items);
        self::assertSame('FV/1', $result->items[0]->number);
        self::assertSame(DocumentType::INVOICE, $result->items[0]->documentType);
    }

    public function testGetInvoiceMapsFixturePayloadToDto(): void
    {
        $client = new FixtureClient();
        $client->getInvoiceResponse = [
            'id' => 7,
            'number' => 'FV/7',
            'currency' => 'PLN',
            'document_type' => 'receipt',
        ];
        $adapter = $this->createAdapter($client);

        $result = $adapter->getInvoice(new GetInvoiceQuery(InvoiceId::fromIntOrString(7)));

        self::assertSame('FV/7', $result->number);
        self::assertSame(DocumentType::RECEIPT, $result->documentType);
        self::assertSame('PLN', $result->currency);
    }

    public function testCreateInvoiceMapsFixturePayloadToDto(): void
    {
        $client = new FixtureClient();
        $client->createInvoiceResponse = [
            'id' => 99,
            'number' => 'FV/99',
            'currency' => 'PLN',
            'document_type' => 'invoice',
        ];
        $adapter = $this->createAdapter($client);

        $result = $adapter->createInvoice(new CreateInvoiceCommand(KeyValuePayload::fromArray(['number' => 'FV/99'])));

        self::assertSame('FV/99', $result->number);
        self::assertSame(DocumentType::INVOICE, $result->documentType);
    }

    public function testListClientsMapsFixturePayloadToDto(): void
    {
        $client = new FixtureClient();
        $client->listClientsResponse = [
            'clients' => [
                [
                    'id' => 11,
                    'name' => 'Acme',
                ],
            ],
        ];
        $adapter = $this->createAdapter($client);

        $result = $adapter->listClients(new ListClientsQuery(page: 1));

        self::assertCount(1, $result->items);
        self::assertSame('Acme', $result->items[0]->name);
        self::assertEquals(ClientId::fromIntOrString(11), $result->items[0]->id);
    }

    public function testCreateClientMapsFixturePayloadToDto(): void
    {
        $client = new FixtureClient();
        $client->createClientResponse = [
            'id' => 12,
            'name' => 'Acme',
        ];
        $adapter = $this->createAdapter($client);

        $result = $adapter->createClient(new CreateClientCommand(KeyValuePayload::fromArray(['name' => 'Acme'])));

        self::assertSame('Acme', $result->name);
        self::assertEquals(ClientId::fromIntOrString(12), $result->id);
    }

    public function testPaymentStatusMapsFixturePayloadToDto(): void
    {
        $client = new FixtureClient();
        $client->paymentStatusResponse = [
            'invoice_id' => 5,
            'invoice_number' => 'FV/5',
            'currency' => 'PLN',
            'total_gross' => 100,
            'left_to_pay' => 0,
            'paid_flag' => true,
            'payment_to' => 'bank_transfer',
            'paid_date' => '2026-04-11',
            'payment_state' => 'paid',
            'connected_payments_count' => 2,
            'connected_payments' => [['id' => 1], ['id' => 2]],
        ];
        $adapter = $this->createAdapter($client);

        $result = $adapter->getInvoicePaymentStatus(new GetInvoicePaymentStatusQuery(InvoiceId::fromIntOrString(5)));

        self::assertSame(PaymentState::PAID, $result->paymentState);
        self::assertSame(2, $result->connectedPaymentsCount);
        self::assertInstanceOf(Money::class, $result->totalGross);
        self::assertInstanceOf(Money::class, $result->leftToPay);
    }

    private function createAdapter(FixtureClient $client): FakturowniaGatewayAdapter
    {
        return new FakturowniaGatewayAdapter($client, new FakturowniaDtoMapper(new PaymentStateResolver()));
    }
}

final class FixtureClient implements FakturowniaClientInterface
{
    public array $listInvoicesResponse = [];

    public array $getInvoiceResponse = [];

    public array $createInvoiceResponse = [];

    public array $listClientsResponse = [];

    public array $createClientResponse = [];

    public array $paymentStatusResponse = [];

    public function listInvoices(array $filters = []): array
    {
        return $this->listInvoicesResponse;
    }

    public function getInvoice(int|string $invoiceId, array $filters = []): array
    {
        return $this->getInvoiceResponse;
    }

    public function createInvoice(array $invoice): array
    {
        return $this->createInvoiceResponse;
    }

    public function listClients(array $filters = []): array
    {
        return $this->listClientsResponse;
    }

    public function createClient(array $client): array
    {
        return $this->createClientResponse;
    }

    public function invoicePaymentStatus(int|string $invoiceId): array
    {
        return $this->paymentStatusResponse;
    }
}
