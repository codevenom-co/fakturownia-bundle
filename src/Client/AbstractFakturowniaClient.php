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
        $baseUrl = rtrim($baseUrl, '/');
        if (!str_starts_with($baseUrl, 'http://') && !str_starts_with($baseUrl, 'https://')) {
            $baseUrl = 'https://'.$baseUrl;
        }

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
     * @param array<string, mixed> $query
     * @param array<string, mixed> $options
     */
    protected function get(string $endpoint, array $query = [], array $options = []): ResponseInterface
    {

        $options['query'] = array_merge($options['query'] ?? [], $query, ['api_token' => $this->apiToken]);

        return $this->sendRequest('GET', $endpoint, $options);
    }

    /**
     * @param array<string, mixed> $jsonPayload
     * @param array<string, mixed> $query
     * @param array<string, mixed> $options
     */
    protected function post(string $endpoint, array $jsonPayload = [], array $query = [], array $options = []): ResponseInterface
    {
        $options['json'] = [
            'api_token' => $this->apiToken,
            ...$jsonPayload
        ];
        $options['query'] = array_merge($options['query'] ?? [], $query);

        return $this->sendRequest('POST', $endpoint, $options);
    }

    /**
     * @param array<string, mixed> $jsonPayload
     * @param array<string, mixed> $query
     * @param array<string, mixed> $options
     */
    protected function put(string $endpoint, array $jsonPayload = [], array $query = [], array $options = []): ResponseInterface
    {
        $options['json'] = [
            'api_token' => $this->apiToken,
            ...$jsonPayload
        ];
        $options['query'] = array_merge($options['query'] ?? [], $query);

        return $this->sendRequest('PUT', $endpoint, $options);
    }

    /**
     * @param array<string, mixed> $jsonPayload
     * @param array<string, mixed> $query
     * @param array<string, mixed> $options
     */
    protected function patch(string $endpoint, array $jsonPayload = [], array $query = [], array $options = []): ResponseInterface
    {
        $options['json'] = $jsonPayload;
        $options['query'] = array_merge($options['query'] ?? [], $query);

        return $this->sendRequest('PATCH', $endpoint, $options);
    }

    /**
     * @param array<string, mixed> $query
     * @param array<string, mixed> $options
     */
    protected function delete(string $endpoint, array $query = [], array $options = []): ResponseInterface
    {
        $options['query'] = array_merge($options['query'] ?? [], $query);

        return $this->sendRequest('DELETE', $endpoint, $options);
    }

    /**
     * @param array<string, mixed> $options Symfony HttpClient options (query/json/body/headers/etc.)
     */
    private function sendRequest(string $method, string $endpoint, array $options = []): ResponseInterface
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