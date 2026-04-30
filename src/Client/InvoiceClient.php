<?php

namespace Codevenom\FakturowniaBundle\Client;

use Codevenom\FakturowniaBundle\Exception\FakturowniaClientException;
use Codevenom\FakturowniaBundle\Exception\FakturowniaException;
use Codevenom\FakturowniaBundle\Exception\InvoiceCreationFailedException;
use Codevenom\FakturowniaBundle\Exception\InvoiceNotFoundException;
use Codevenom\FakturowniaBundle\Exception\UnableToRetrieveInvoicesForProvidedPeriodException;
use Codevenom\FakturowniaBundle\Invoice\Enum\InvoicePeriod;
use Codevenom\FakturowniaBundle\Invoice\Mapper\CreateInvoicePayloadMapper;
use Codevenom\FakturowniaBundle\Invoice\Mapper\InvoicePayloadMapper;
use Codevenom\FakturowniaBundle\Invoice\Model\CreateInvoice;
use Codevenom\FakturowniaBundle\Invoice\Model\Invoice;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Exception\ExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

class InvoiceClient extends AbstractFakturowniaClient implements FakturowniaInvoiceClientInterface
{

    public function __construct(
        string                                      $baseUrl,
        string                                      $apiToken,
        int                                         $timeout,
        private readonly string                     $sellerName,
        private readonly string                     $sellerTaxId,
        private readonly InvoicePayloadMapper       $invoicePayloadMapper,
        private readonly CreateInvoicePayloadMapper $createInvoicePayloadMapper,
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
        $request->setSellerTaxNo($this->sellerTaxId);

        $jsonPayload = $this->createInvoicePayloadMapper->toPayload($request);
        $response = $this->post('/invoices.json', $jsonPayload);

        if ($response->getStatusCode() !== Response::HTTP_CREATED) {
            throw new InvoiceCreationFailedException(sprintf(
                'Invoice creation failed with status code %s: %s',
                $response->getStatusCode(),
                $response->getContent(false),
            ));
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
        $response = $this->get('/invoices.json',
            query: [
                'period' => $period->value,
                'page' => $page,
                'per_page' => $perPage,
                'income' => $income ? 'yes' : 'no',
            ]);

        if ($response->getStatusCode() !== Response::HTTP_OK) {
            throw UnableToRetrieveInvoicesForProvidedPeriodException::withPeriod($period);
        }

        return array_map(fn(array $invoiceData): Invoice => $this->invoicePayloadMapper->toModel($invoiceData), $response->toArray());
    }

    /**
     * @param string $id
     * @return Invoice
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws ExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function findById(string $id): Invoice
    {
        $response = $this->get(sprintf('/invoices/%s.json', $id));

        if ($response->getStatusCode() !== Response::HTTP_NOT_FOUND) {
            throw InvoiceNotFoundException::withId($id);
        }
        return $this->invoicePayloadMapper->toModel($response->toArray());
    }

    public function findByNumber(string $number, bool $income = true): ?Invoice
    {
        $response = $this->get('/invoices.json',
            query: [
                'number' => $number,
                'income' => $income ? 'yes' : 'no',
            ]);

        if ($response->getStatusCode() !== Response::HTTP_OK) {
            throw InvoiceNotFoundException::withNumber($number);
        }

        $invoices = array_map(fn(array $invoiceData): Invoice => $this->invoicePayloadMapper->toModel($invoiceData), $response->toArray());

        if (count($invoices) > 1) {
            throw InvoiceNotFoundException::withNumber($number);
        }

        if ($invoices[0]->getNumber() === null) {
            throw InvoiceNotFoundException::withNumber($number);
        }

        return $invoices[0];
    }


    public function listInvoices(array $query): array
    {
        $response = $this->get('/invoices.json', query: $query);

        if ($response->getStatusCode() !== Response::HTTP_OK) {
            throw new FakturowniaClientException(sprintf(
                'Failed to list invoices: %s',
                $response->getContent(false)
            ));
        }

        return array_map(fn(array $invoiceData): Invoice => $this->invoicePayloadMapper->toModel($invoiceData), $response->toArray());
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