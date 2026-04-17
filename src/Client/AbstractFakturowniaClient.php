<?php

namespace Codevenom\FakturowniaBundle\Client;

use Codevenom\FakturowniaBundle\Exception\FakturowniaClientException;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

abstract class AbstractFakturowniaClient
{
    private readonly HttpClientInterface $httpClient;

    public function __construct(
        string $baseUrl,
        private readonly string $apiToken,
        int $timeout = 10
    ) {
        $this->httpClient = HttpClient::create([
            'base_uri' => $baseUrl,
            'timeout' => $timeout,
            'max_duration' => $timeout,
            'headers' => [
                'Accept' => 'application/json',
            ],
        ]);
    }

    /**
     * Thin wrapper over Symfony HttpClient with automatic api_token injection into query.
     *
     * @param array<string, mixed> $options Symfony HttpClient options (query/json/body/headers/etc.)
     */
    protected function sendRequest(string $method, string $endpoint, array $options = []): ResponseInterface
    {
        $query = $options['query'] ?? [];
        if (!\is_array($query)) {
            $query = [];
        }

        $query['api_token'] = $this->apiToken;
        $options['query'] = $query;

        try {
            return $this->httpClient->request($method, $endpoint, $options);
        } catch (TransportExceptionInterface $e) {
            throw new FakturowniaClientException(sprintf(
                'Error while sending request to Fakturownia API: %s',
                $e->getMessage(),
            ));
        }
    }
}