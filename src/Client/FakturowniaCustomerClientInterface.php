<?php

namespace Codevenom\FakturowniaBundle\Client;

use Codevenom\FakturowniaBundle\Customer\Model\Customer;
use Codevenom\FakturowniaBundle\Exception\FakturowniaClientException;
use Symfony\Component\Serializer\Exception\ExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

interface FakturowniaCustomerClientInterface
{
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
    public function listCustomers(array $query): array;

    /**
     * @throws RedirectionExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws ClientExceptionInterface
     * @throws TransportExceptionInterface
     * @throws FakturowniaClientException
     * @throws ServerExceptionInterface
     * @throws ExceptionInterface
     */
    public function findById(int $id): Customer;
    public function create(Customer $customer): Customer;
    public function update(Customer $customer): Customer;
    public function deleteCustomer(int $id): void;
}