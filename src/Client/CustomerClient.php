<?php

namespace Codevenom\FakturowniaBundle\Client;

use Codevenom\FakturowniaBundle\Customer\Mapper\CustomerPayloadMapper;
use Codevenom\FakturowniaBundle\Customer\Model\Customer;
use Codevenom\FakturowniaBundle\Customer\Model\UpdateCustomer;
use Codevenom\FakturowniaBundle\Exception\FakturowniaClientException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Exception\ExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

class CustomerClient extends AbstractFakturowniaClient implements FakturowniaCustomerClientInterface
{
    public function __construct(
        string $baseUrl,
        string $apiToken,
        int $timeout,
        private readonly CustomerPayloadMapper $customerPayloadMapper,
    ) {
        parent::__construct(
            baseUrl: $baseUrl,
            apiToken: $apiToken,
            timeout: $timeout
        );
    }

    /**
     * @param array<string, mixed> $query
     * @return array<int, Customer>
     * @throws FakturowniaClientException
     * @throws ExceptionInterface
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function listCustomers(array $query): array
    {
        $response = $this->get('/clients.json', query: $query);

        if ($response->getStatusCode() !== Response::HTTP_OK) {
            throw new FakturowniaClientException(sprintf(
                'Failed to list customers: %s',
                $response->getContent(false)
            ));
        }

        return array_map(
            fn(array $customerData): Customer => $this->customerPayloadMapper->toModel($customerData),
            $response->toArray()
        );
    }

    /**
     * @throws RedirectionExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws ClientExceptionInterface
     * @throws TransportExceptionInterface
     * @throws FakturowniaClientException
     * @throws ServerExceptionInterface
     * @throws ExceptionInterface
     */
    public function findById(int $id): Customer
    {
        $response = $this->get(sprintf('/clients/%s.json', $id));

        if ($response->getStatusCode() !== Response::HTTP_OK) {
            throw new FakturowniaClientException(sprintf(
                'Failed to find customer with ID %d: %s',
                $id,
                $response->getContent(false)
            ));
        }

        return $this->customerPayloadMapper->toModel($response->toArray());
    }

    public function create(Customer $customer): Customer
    {
        $response = $this->post('/clients.json', [
            'client' => $this->customerPayloadMapper->toPayload($customer),
        ]);

        if ($response->getStatusCode() !== Response::HTTP_CREATED && $response->getStatusCode() !== Response::HTTP_OK) {
            throw new FakturowniaClientException(sprintf(
                'Failed to create customer: %s',
                $response->getContent(false)
            ));
        }

        return $this->customerPayloadMapper->toModel($response->toArray());
    }

    public function update(Customer $customer): Customer
    {
        if (null === $customer->getId()) {
            throw new FakturowniaClientException('Cannot update customer without ID');
        }

        $updateModel = new UpdateCustomer();
        $newCustomerPayload = $this->customerPayloadMapper->toPayload($customer);
        $this->customerPayloadMapper->toModel($newCustomerPayload, $updateModel, UpdateCustomer::class);

        $response = $this->put(sprintf('/clients/%s.json', $customer->getId()), [
            'client' => $this->customerPayloadMapper->toPayload($updateModel),
        ]);

        if ($response->getStatusCode() !== Response::HTTP_OK) {
            throw new FakturowniaClientException(sprintf(
                'Failed to update customer with ID %d: %s',
                $customer->getId(),
                $response->getContent(false)
            ));
        }

        return $this->customerPayloadMapper->toModel($response->toArray());
    }

    public function deleteCustomer(int $id): void
    {
        $response = parent::delete(sprintf('/clients/%s.json', $id));

        if ($response->getStatusCode() !== Response::HTTP_OK && $response->getStatusCode() !== Response::HTTP_NO_CONTENT) {
            throw new FakturowniaClientException(sprintf(
                'Failed to delete customer with ID %d: %s',
                $id,
                $response->getContent(false)
            ));
        }
    }
}
