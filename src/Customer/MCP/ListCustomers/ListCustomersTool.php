<?php

namespace Codevenom\FakturowniaBundle\Customer\MCP\ListCustomers;

use Codevenom\FakturowniaBundle\Customer\CustomerManagerInterface;
use Codevenom\FakturowniaBundle\Customer\Mapper\CustomerPayloadMapper;
use Codevenom\FakturowniaBundle\Customer\Model\Customer;
use Codevenom\FakturowniaBundle\Shared\MCP\McpToolExecutor;
use Codevenom\FakturowniaBundle\Shared\MCP\Response\McpResponder;
use Codevenom\FakturowniaBundle\Shared\MCP\Validation\McpInputValidator;
use Mcp\Capability\Attribute\McpTool;
use Symfony\Component\DependencyInjection\Attribute\AutoconfigureTag;

#[McpTool(
    name: 'codevenom.fakturownia.customer.list',
    description: 'Lists all customers from Fakturownia. Supports filtering via query parameters.'
)]
#[AutoconfigureTag('mcp.tool')]
final class ListCustomersTool
{
    public function __construct(
        private CustomerManagerInterface $customerManager,
        private CustomerPayloadMapper    $customerPayloadMapper,
        private McpResponder            $responder,
        private McpToolExecutor         $executor,
        private McpInputValidator       $inputValidator,
    ) {
    }

    /**
     * @param array<string, mixed> $query
     * @return array<string, mixed>
     */
    public function __invoke(array $query = []): array
    {
        return $this->executor->execute(function () use ($query): array {
            $input = new ListCustomersInput($query);

            $this->inputValidator->validate($input);

            $customers = $this->customerManager->listCustomers($input->getQuery());
            $payload = [];

            foreach ($customers as $customer) {
                if ($customer instanceof Customer) {
                    $payload[] = $this->customerPayloadMapper->toPayload($customer);
                }
            }

            return $this->responder->success($payload);
        });
    }
}
