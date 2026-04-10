<?php

declare(strict_types=1);

namespace Codevenom\FakturowniaBundle\Tests\Unit\Http;

use Codevenom\FakturowniaBundle\Http\FakturowniaClient;
use Codevenom\FakturowniaBundle\Infrastructure\FakturowniaApi\Exception\ApiResponseException;
use Codevenom\FakturowniaBundle\Infrastructure\FakturowniaApi\Exception\ApiTransportException;
use Codevenom\FakturowniaBundle\Infrastructure\FakturowniaApi\Exception\ApiValidationException;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpClient\MockHttpClient;
use Symfony\Component\HttpClient\Response\MockResponse;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

final class FakturowniaClientTest extends TestCase
{
    public function testItThrowsValidationExceptionForEmptyInvoicePayload(): void
    {
        $client = new FakturowniaClient(new MockHttpClient(), 'https://example.test', 'token', 10);

        $this->expectException(ApiValidationException::class);
        $client->createInvoice([]);
    }

    public function testItMapsTransportExceptionToTypedException(): void
    {
        $httpClient = new MockHttpClient(static function (string $method, string $url, array $options) {
            throw new class('boom') extends \RuntimeException implements TransportExceptionInterface {
            };
        });
        $client = new FakturowniaClient($httpClient, 'https://example.test', 'token', 10);

        $this->expectException(ApiTransportException::class);
        $client->listInvoices();
    }

    public function testItMapsHttpErrorResponseToTypedException(): void
    {
        $httpClient = new MockHttpClient(static function (string $method, string $url, array $options): MockResponse {
            return new MockResponse('{"error":"bad"}', ['http_code' => 500, 'response_headers' => ['content-type: application/json']]);
        });
        $client = new FakturowniaClient($httpClient, 'https://example.test', 'token', 10);

        $this->expectException(ApiResponseException::class);
        $client->listInvoices();
    }
}
