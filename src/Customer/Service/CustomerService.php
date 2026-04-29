<?php

namespace Codevenom\FakturowniaBundle\Customer\Service;

use Codevenom\FakturowniaBundle\Client\CustomerClient;
use Codevenom\FakturowniaBundle\Customer\Model\Customer;

final readonly class CustomerService
{
    public function __construct(
        private CustomerClient $client
    ) {
    }

    /**
     * @param array<string, mixed> $query
     * @return iterable<Customer>
     */
    public function listCustomers(array $query): iterable
    {
        $page = 1;
        $perPage = 100;
        $maxPages = 100;

        $queryParams = array_merge($query, [
            'per_page' => $perPage,
        ]);

        while ($page <= $maxPages) {
            $queryParams['page'] = $page;
            $customers = $this->client->listCustomers($queryParams);

            if (empty($customers)) {
                break;
            }

            foreach ($customers as $customer) {
                yield $customer;
            }

            if (count($customers) < $perPage) {
                break;
            }

            $page++;
        }
    }

    public function findById(int $id): Customer
    {
        return $this->client->findById($id);
    }

    public function create(Customer $customer): Customer
    {
        return $this->client->create($customer);
    }

    public function update(Customer $customer): Customer
    {
        return $this->client->update($customer);
    }

    public function delete(int $id): void
    {
        $this->client->deleteCustomer($id);
    }
}
