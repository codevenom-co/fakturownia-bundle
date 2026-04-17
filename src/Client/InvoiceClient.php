<?php

namespace Codevenom\FakturowniaBundle\Client;

use Codevenom\FakturowniaBundle\Exception\FakturowniaException;
use Codevenom\FakturowniaBundle\Exception\InvoiceCreationFailedException;
use Codevenom\FakturowniaBundle\Exception\InvoiceNotFoundException;
use Codevenom\FakturowniaBundle\Exception\UnableToRetrieveInvoicesForProvidedPeriodException;
use Codevenom\FakturowniaBundle\Invoice\Enum\InvoicePeriod;
use Codevenom\FakturowniaBundle\Invoice\Mapper\InvoicePayloadMapper;
use Codevenom\FakturowniaBundle\Invoice\Model\CreateInvoice;
use Codevenom\FakturowniaBundle\Invoice\Model\Invoice;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Exception\ExceptionInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

class InvoiceClient extends AbstractFakturowniaClient implements FakturowniaClientInterface
{

    public function __construct(
        string                                $baseUrl,
        string                                $apiToken,
        int                                   $timeout,
        private readonly string               $sellerName,
        private readonly InvoicePayloadMapper $invoicePayloadMapper
    )
    {
        parent::__construct(
            baseUrl: $baseUrl,
            apiToken: $apiToken,
            timeout: $timeout
        );
    }

    /**
     * @param CreateInvoice $request
     * @return Invoice
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws ExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function createInvoice(CreateInvoice $request): Invoice
    {
        $request->setSellerName($this->sellerName);
        $httpPayload = $this->invoicePayloadMapper->toPayload($request);
        $response = $this->sendRequest('POST', '/invoices.json', $httpPayload);

        if ($response->getStatusCode() !== Response::HTTP_CREATED) {
            throw new InvoiceCreationFailedException(sprintf('Invoice creation failed with status code %s: %s', $response->getStatusCode(), $response->getContent(false)));
        }
        return $this->invoicePayloadMapper->toModel($response->toArray());
    }

    /**
     * @param InvoicePeriod $period
     * @param int $page
     * @param int $perPage
     * @param bool $income
     * @return array
     * @throws ClientExceptionInterface
     * @throws ExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     * @throws DecodingExceptionInterface
     */
    public function findByPeriod(InvoicePeriod $period, int $page, int $perPage, bool $income = true): array
    {
        $response = $this->sendRequest('GET', '/invoices.json', [
            'query' => [
                'period' => $period->value,
                'page' => $page,
                'per_page' => $perPage,
                'income' => $income ? 'yes' : 'no',
            ],
        ]);

        if ($response->getStatusCode() !== Response::HTTP_OK) {
            throw UnableToRetrieveInvoicesForProvidedPeriodException::withPeriod($period);
        }

        return array_map(fn(array $invoiceData): Invoice => $this->invoicePayloadMapper->toModel($invoiceData), $response->toArray());
    }

    /**
     * @param string $id
     * @return Invoice
     * @throws TransportExceptionInterface
     * @throws ExceptionInterface
     * @throws ClientExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     */
    public function findById(string $id): Invoice
    {
        $response = $this->sendRequest('GET', sprintf('/invoices/%s.json', $id));

        if ($response->getStatusCode() !== Response::HTTP_NOT_FOUND) {
            throw new InvoiceNotFoundException(sprintf('Error while fetching invoice with id %s: %s', $id, $response->getContent(false)));
        }
        return $this->invoicePayloadMapper->toModel($response->toArray());
    }

    /**
     * @param string $id
     * @return string
     */
    public function downloadInvoice(string $id): string
    {
        return "";
    }
}