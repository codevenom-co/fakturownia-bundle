<?php

declare(strict_types=1);

namespace Codevenom\FakturowniaBundle\Infrastructure\FakturowniaApi\Http;

use Codevenom\FakturowniaBundle\Infrastructure\FakturowniaApi\Exception\ApiResponseException;
use Codevenom\FakturowniaBundle\Infrastructure\FakturowniaApi\Exception\ApiTransportException;
use Codevenom\FakturowniaBundle\Infrastructure\FakturowniaApi\Exception\ApiValidationException;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

final class FakturowniaClient implements FakturowniaClientInterface
{
    public function __construct(
        private readonly HttpClientInterface $httpClient,
        private readonly string $baseUrl,
        private readonly string $sellerName,
        private readonly string $apiToken,
        private readonly int $timeout,
    ) {
    }

    public function listInvoices(array $filters = []): array
    {
        return $this->request('GET', '/invoices.json', $filters);
    }

    public function getInvoice(int|string $invoiceId, array $filters = []): array
    {
        if ('' === (string) $invoiceId) {
            throw new ApiValidationException('invoiceId jest wymagane.');
        }

        return $this->request('GET', sprintf('/invoices/%s.json', $invoiceId), $filters);
    }

    public function createInvoice(array $invoice): array
    {
        if ([] === $invoice) {
            throw new ApiValidationException('invoice nie moze byc puste.');
        }

        return $this->request('POST', '/invoices.json', [], ['invoice' => $invoice]);
    }

    public function listClients(array $filters = []): array
    {
        return $this->request('GET', '/clients.json', $filters);
    }

    public function createClient(array $client): array
    {
        if ([] === $client) {
            throw new ApiValidationException('client nie moze byc pusty.');
        }

        return $this->request('POST', '/clients.json', [], ['client' => $client]);
    }

    public function invoicePaymentStatus(int|string $invoiceId): array
    {
        $invoice = $this->getInvoice($invoiceId, [
            'additional_fields[invoice]' => 'connected_payments',
        ]);

        $leftToPay = $this->toFloatOrNull($invoice['left_to_pay'] ?? null);
        $totalGross = $this->toFloatOrNull($invoice['price_gross'] ?? null);
        $paidFlag = $invoice['paid'] ?? null;

        $paymentState = 'unknown';
        if (true === $paidFlag || (null !== $leftToPay && $leftToPay <= 0.0)) {
            $paymentState = 'paid';
        } elseif (null !== $leftToPay && null !== $totalGross && $leftToPay < $totalGross) {
            $paymentState = 'partially_paid';
        } elseif (null !== $leftToPay) {
            $paymentState = 'unpaid';
        }

        $connected = [];
        if (isset($invoice['connected_payments']) && \is_array($invoice['connected_payments'])) {
            $connected = $invoice['connected_payments'];
        } elseif (isset($invoice['payments']) && \is_array($invoice['payments'])) {
            $connected = $invoice['payments'];
        } elseif (isset($invoice['bankings']) && \is_array($invoice['bankings'])) {
            $connected = $invoice['bankings'];
        }

        return [
            'invoice_id' => $invoice['id'] ?? null,
            'invoice_number' => $invoice['number'] ?? null,
            'currency' => $invoice['currency'] ?? null,
            'total_gross' => $totalGross,
            'left_to_pay' => $leftToPay,
            'paid_flag' => $paidFlag,
            'payment_to' => $invoice['payment_to'] ?? null,
            'paid_date' => $invoice['paid_date'] ?? null,
            'payment_state' => $paymentState,
            'connected_payments_count' => \count($connected),
            'connected_payments' => $connected,
        ];
    }

    private function request(string $method, string $path, array $query = [], ?array $json = null): array
    {
        $url = rtrim($this->baseUrl, '/').'/'.ltrim($path, '/');

        $query = $this->compact(array_merge($query, ['api_token' => $this->apiToken]));

        $options = [
            'query' => $query,
            'timeout' => $this->timeout,
            'headers' => [
                'Accept' => 'application/json',
            ],
        ];

        if (null !== $json) {
            $options['json'] = $json;
        }

        try {
            $response = $this->httpClient->request($method, $url, $options);
            $statusCode = $response->getStatusCode();
            $content = $response->toArray(false);
        } catch (TransportExceptionInterface $e) {
            throw new ApiTransportException('Blad transportu do Fakturowni: '.$e->getMessage(), $e);
        }

        if ($statusCode >= 400) {
            throw new ApiResponseException(
                sprintf('Fakturownia API zwrocilo HTTP %d.', $statusCode),
                $statusCode,
                \is_array($content) ? $content : [],
            );
        }

        return \is_array($content) ? $content : [];
    }

    private function compact(array $data): array
    {
        return array_filter(
            $data,
            static fn (mixed $value): bool => null !== $value && '' !== $value
        );
    }

    private function toFloatOrNull(mixed $value): ?float
    {
        if (null === $value || '' === $value) {
            return null;
        }

        if (\is_numeric($value)) {
            return (float) $value;
        }

        return null;
    }
}
