<?php

declare(strict_types=1);

namespace Codevenom\FakturowniaBundle\Tests\Unit\Mcp\Mapper;

use Codevenom\FakturowniaBundle\Application\DTO\ClientDto;
use Codevenom\FakturowniaBundle\Application\DTO\ClientListDto;
use Codevenom\FakturowniaBundle\Application\DTO\InvoiceDto;
use Codevenom\FakturowniaBundle\Application\DTO\InvoiceListDto;
use Codevenom\FakturowniaBundle\Application\DTO\PaymentStatusDto;
use Codevenom\FakturowniaBundle\Domain\Enum\DocumentType;
use Codevenom\FakturowniaBundle\Domain\Enum\PaymentState;
use Codevenom\FakturowniaBundle\Domain\ValueObject\ClientId;
use Codevenom\FakturowniaBundle\Domain\ValueObject\InvoiceId;
use Codevenom\FakturowniaBundle\Domain\ValueObject\KeyValuePayload;
use Codevenom\FakturowniaBundle\Domain\ValueObject\Money;
use Codevenom\FakturowniaBundle\Mcp\Mapper\McpInputMapper;
use Codevenom\FakturowniaBundle\Mcp\Mapper\McpOutputMapper;
use PHPUnit\Framework\TestCase;

final class McpMapperTest extends TestCase
{
    public function testInputMapperBuildsListInvoicesQuery(): void
    {
        $mapper = new McpInputMapper();
        $query = $mapper->mapListInvoices(1, 10, 'last_month', true, 7, 'FV/1', 'desc', 'income', '2026-01-01', '2026-01-31', 'issue_date');

        self::assertSame(1, $query->page);
        self::assertSame(10, $query->perPage);
        self::assertSame('last_month', $query->period);
        self::assertSame(true, $query->includePositions);
        self::assertEquals(ClientId::fromIntOrString(7), $query->clientId);
    }

    public function testInputMapperBuildsCommandAndQueryDtos(): void
    {
        $mapper = new McpInputMapper();

        self::assertSame('9', $mapper->mapGetInvoice(9, null)->invoiceId->value);
        self::assertSame(['number' => 'FV/9'], $mapper->mapCreateInvoice(['number' => 'FV/9'])->invoice->toArray());
        self::assertSame('Acme', $mapper->mapCreateClient(['name' => 'Acme'])->client->toArray()['name']);
        self::assertSame('5', $mapper->mapInvoicePaymentStatus(5)->invoiceId->value);
    }

    public function testOutputMapperReturnsTransportArrays(): void
    {
        $mapper = new McpOutputMapper();
        $invoiceList = new InvoiceListDto([], KeyValuePayload::fromArray(['invoices' => []]));
        $invoice = new InvoiceDto(null, 'FV/1', 'PLN', DocumentType::INVOICE, KeyValuePayload::fromArray(['number' => 'FV/1']));
        $clientList = new ClientListDto([], KeyValuePayload::fromArray(['clients' => []]));
        $client = new ClientDto(null, 'Acme', KeyValuePayload::fromArray(['name' => 'Acme']));
        $paymentStatus = new PaymentStatusDto(
            InvoiceId::fromIntOrString(1),
            'FV/1',
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

        self::assertSame(['invoices' => []], $mapper->mapInvoiceList($invoiceList));
        self::assertSame(['number' => 'FV/1'], $mapper->mapInvoice($invoice));
        self::assertSame(['clients' => []], $mapper->mapClientList($clientList));
        self::assertSame(['name' => 'Acme'], $mapper->mapClient($client));
        self::assertSame(['payment_state' => 'paid'], $mapper->mapPaymentStatus($paymentStatus));
    }
}
