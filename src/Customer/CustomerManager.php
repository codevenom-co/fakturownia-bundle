<?php

namespace Codevenom\FakturowniaBundle\Customer;

use Codevenom\FakturowniaBundle\Customer\Model\Customer;
use Codevenom\FakturowniaBundle\Customer\Service\CustomerService;

readonly class CustomerManager implements CustomerManagerInterface
{
    public function __construct(
        private CustomerService $customerService
    ) {
    }

    public function listCustomers(array $query): iterable
    {
        return $this->customerService->listCustomers($query);
    }

    public function findById(int $id): Customer
    {
        return $this->customerService->findById($id);
    }

    public function create(Customer $customer): Customer
    {
        return $this->customerService->create($customer);
    }

    public function update(Customer $customer): Customer
    {
        return $this->customerService->update($customer);
    }

    public function delete(int $id): void
    {
        $this->customerService->delete($id);
    }
}
