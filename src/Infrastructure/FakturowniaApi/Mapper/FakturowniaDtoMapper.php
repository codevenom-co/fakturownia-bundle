<?php

declare(strict_types=1);

namespace Codevenom\FakturowniaBundle\Infrastructure\FakturowniaApi\Mapper;

use Codevenom\FakturowniaBundle\Application\DTO\ClientDto;
use Codevenom\FakturowniaBundle\Application\DTO\ClientListDto;
use Codevenom\FakturowniaBundle\Application\DTO\InvoiceDto;
use Codevenom\FakturowniaBundle\Application\DTO\InvoiceListDto;
use Codevenom\FakturowniaBundle\Application\DTO\PaymentStatusDto;
use Codevenom\FakturowniaBundle\Application\Query\GetInvoiceQuery;
use Codevenom\FakturowniaBundle\Application\Query\ListClientsQuery;
use Codevenom\FakturowniaBundle\Application\Query\ListInvoicesQuery;
use Codevenom\FakturowniaBundle\Domain\Enum\DocumentType;
use Codevenom\FakturowniaBundle\Domain\Strategy\PaymentStateResolver;
use Codevenom\FakturowniaBundle\Domain\ValueObject\ClientId;
use Codevenom\FakturowniaBundle\Domain\ValueObject\InvoiceId;
use Codevenom\FakturowniaBundle\Domain\ValueObject\KeyValuePayload;
use Codevenom\FakturowniaBundle\Domain\ValueObject\Money;

final class FakturowniaDtoMapper
{
    public function __construct(private readonly PaymentStateResolver $paymentStateResolver)
    {
    }

    public function mapListInvoicesQueryToFilters(ListInvoicesQuery $query): array
    {
        return array_filter([
            'page' => $query->page,
            'per_page' => $query->perPage,
            'period' => $query->period,
            'include_positions' => $query->includePositions,
            'client_id' => $query->clientId?->value,
            'number' => $query->number,
            'order' => $query->order,
            'income' => $query->income,
            'date_from' => $query->dateFrom,
            'date_to' => $query->dateTo,
            'search_date_type' => $query->searchDateType,
        ], static fn (mixed $value): bool => null !== $value);
    }

    public function mapGetInvoiceQueryToFilters(GetInvoiceQuery $query): array
    {
        return array_filter([
            'include_positions' => $query->includePositions,
        ], static fn (mixed $value): bool => null !== $value);
    }

    public function mapListClientsQueryToFilters(ListClientsQuery $query): array
    {
        return array_filter([
            'page' => $query->page,
            'per_page' => $query->perPage,
            'query' => $query->query,
            'external_id' => $query->externalId?->value,
        ], static fn (mixed $value): bool => null !== $value);
    }

    public function mapInvoice(array $payload): InvoiceDto
    {
        $documentType = DocumentType::fromApiPayload($payload);

        return new InvoiceDto(
            isset($payload['id']) ? InvoiceId::fromIntOrString((string) $payload['id']) : null,
            isset($payload['number']) ? (string) $payload['number'] : null,
            isset($payload['currency']) ? (string) $payload['currency'] : null,
            $documentType,
            KeyValuePayload::fromArray(array_merge($payload, ['document_type' => $documentType->value])),
        );
    }

    public function mapClient(array $payload): ClientDto
    {
        return new ClientDto(
            isset($payload['id']) ? ClientId::fromIntOrString((string) $payload['id']) : null,
            isset($payload['name']) ? (string) $payload['name'] : null,
            KeyValuePayload::fromArray($payload),
        );
    }

    public function mapInvoiceList(array $payload): InvoiceListDto
    {
        $itemsRaw = $this->extractList($payload, 'invoices');
        $items = array_map(fn (array $item): InvoiceDto => $this->mapInvoice($item), $itemsRaw);

        return new InvoiceListDto($items, KeyValuePayload::fromArray($payload));
    }

    public function mapClientList(array $payload): ClientListDto
    {
        $itemsRaw = $this->extractList($payload, 'clients');
        $items = array_map(fn (array $item): ClientDto => $this->mapClient($item), $itemsRaw);

        return new ClientListDto($items, KeyValuePayload::fromArray($payload));
    }

    public function mapPaymentStatus(array $payload): PaymentStatusDto
    {
        $currency = isset($payload['currency']) ? (string) $payload['currency'] : null;
        $totalGross = $this->mapMoney($payload['total_gross'] ?? null, $currency);
        $leftToPay = $this->mapMoney($payload['left_to_pay'] ?? null, $currency);
        $paymentState = $this->paymentStateResolver->resolve($payload);

        return new PaymentStatusDto(
            isset($payload['invoice_id']) ? InvoiceId::fromIntOrString((string) $payload['invoice_id']) : null,
            isset($payload['invoice_number']) ? (string) $payload['invoice_number'] : null,
            $currency,
            $totalGross,
            $leftToPay,
            isset($payload['paid_flag']) ? (bool) $payload['paid_flag'] : null,
            isset($payload['payment_to']) ? (string) $payload['payment_to'] : null,
            isset($payload['paid_date']) ? (string) $payload['paid_date'] : null,
            $paymentState,
            isset($payload['connected_payments_count']) ? (int) $payload['connected_payments_count'] : 0,
            KeyValuePayload::fromArray(array_merge($payload, ['payment_state' => $paymentState->value])),
        );
    }

    private function extractList(array $payload, string $collectionKey): array
    {
        if (isset($payload[$collectionKey]) && \is_array($payload[$collectionKey])) {
            return array_values(array_filter($payload[$collectionKey], static fn (mixed $item): bool => \is_array($item)));
        }

        if (array_is_list($payload)) {
            return array_values(array_filter($payload, static fn (mixed $item): bool => \is_array($item)));
        }

        return [];
    }

    private function mapMoney(mixed $amount, ?string $currency): ?Money
    {
        if (null === $amount || '' === $amount || null === $currency || '' === $currency) {
            return null;
        }

        if (!\is_numeric($amount)) {
            return null;
        }

        $numericAmount = (float) $amount;

        if ($numericAmount < 0) {
            return null;
        }

        return new Money($numericAmount, $currency);
    }
}
