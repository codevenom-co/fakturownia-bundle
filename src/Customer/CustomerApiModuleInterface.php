<?php

namespace Codevenom\FakturowniaBundle\Customer;

use Codevenom\FakturowniaBundle\Customer\Model\Customer;

interface CustomerApiModuleInterface
{
    /**
     * @param array<string, mixed> $query
     * @return iterable<Customer>
     */
    public function listCustomers(array $query): iterable;

    public function findById(int $id): Customer;

    public function create(Customer $customer): Customer;

    public function update(Customer $customer): Customer;

    public function delete(int $id): void;
}
