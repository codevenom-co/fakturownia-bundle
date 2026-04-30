<?php

namespace Codevenom\FakturowniaBundle\Customer;

use Codevenom\FakturowniaBundle\Customer\Model\Customer;

final class CustomerApiModule implements CustomerApiModuleInterface
{
    public function __construct(
        private CustomerManagerInterface $customerManager,
    ) {
    }

    public function listCustomers(array $query): iterable
    {
        return $this->customerManager->listCustomers($query);
    }

    public function findById(int $id): Customer
    {
        return $this->customerManager->findById($id);
    }

    public function create(Customer $customer): Customer
    {
        return $this->customerManager->create($customer);
    }

    public function update(Customer $customer): Customer
    {
        return $this->customerManager->update($customer);
    }

    public function delete(int $id): void
    {
        $this->customerManager->delete($id);
    }
}
