<?php

declare(strict_types=1);

namespace Codevenom\FakturowniaBundle\Tests\Unit\Http;

use Codevenom\FakturowniaBundle\Infrastructure\FakturowniaApi\Exception\ApiResponseException;
use Codevenom\FakturowniaBundle\Infrastructure\FakturowniaApi\Exception\ApiTransportException;
use Codevenom\FakturowniaBundle\Infrastructure\FakturowniaApi\Exception\ApiValidationException;
use Codevenom\FakturowniaBundle\Infrastructure\FakturowniaApi\Http\FakturowniaClient;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpClient\MockHttpClient;
use Symfony\Component\HttpClient\Response\MockResponse;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

final class FakturowniaClientTest extends TestCase
{
    public function testItThrowsValidationExceptionForEmptyInvoicePayload(): void
    {
        $client = new FakturowniaClient(
            new MockHttpClient(),
            'https://example.test',
            'seller',
            'token',
            10,
        );

        $this->expectException(ApiValidationException::class);
        $client->createInvoice([]);
    }

    public function testItMapsTransportExceptionToTypedException(): void
    {
        $client = $this->getClient();

        $this->expectException(ApiTransportException::class);
        $client->listInvoices();
    }

    public function testItMapsHttpErrorResponseToTypedException(): void
    {
        $client = $this->getClient();

        $this->expectException(ApiResponseException::class);
        $client->listInvoices();
    }

    private function getClient(HttpClientInterface $httpClient = null): FakturowniaClient
    {
        $baseUrl = getenv('FAKTUROWNIA_BASE_URL') ?: 'https://example.test';
        $seller = getenv('FAKTUROWNIA_API_TOKEN') ?: 'token';
        $apiToken = getenv('FAKTUROWNIA_API_TOKEN') ?: 'token';

        return new FakturowniaClient(
            $httpClient ?? new MockHttpClient(),
            $baseUrl,
            $apiToken,
            $seller,
            10
        );
    }
}
