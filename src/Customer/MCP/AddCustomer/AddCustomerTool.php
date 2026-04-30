<?php

namespace Codevenom\FakturowniaBundle\Customer\MCP\AddCustomer;

use Codevenom\FakturowniaBundle\Customer\CustomerApiModuleInterface;
use Codevenom\FakturowniaBundle\Customer\Mapper\CustomerPayloadMapper;
use Codevenom\FakturowniaBundle\Customer\Model\Customer;
use Codevenom\FakturowniaBundle\Shared\MCP\McpToolExecutor;
use Codevenom\FakturowniaBundle\Shared\MCP\Response\McpResponder;
use Codevenom\FakturowniaBundle\Shared\MCP\Utility\McpInputNormalizer;
use Codevenom\FakturowniaBundle\Shared\MCP\Validation\McpInputValidator;
use Mcp\Capability\Attribute\McpTool;
use Symfony\Component\DependencyInjection\Attribute\AutoconfigureTag;

#[McpTool(
    name: 'codevenom.fakturownia.customer.add',
    description: 'Add a new customer to Fakturownia'
)]
#[AutoconfigureTag('mcp.tool')]
final class AddCustomerTool
{
    public function __construct(
        private CustomerApiModuleInterface $customerApiModule,
        private CustomerPayloadMapper      $customerPayloadMapper,
        private McpResponder              $responder,
        private McpToolExecutor           $executor,
        private McpInputValidator         $inputValidator,
    ) {
    }

    /**
     * @param array<string|int, mixed> $client
     * @return array<string, mixed>
     */
    public function __invoke(array $client): array
    {
        return $this->executor->execute(function () use ($client): array {
            $input = new AddCustomerInput(McpInputNormalizer::normalize($client));
            $this->inputValidator->validate($input);

            /** @var Customer $customer */
            $customer = $this->customerPayloadMapper->toModel($input->getClientData());
            $createdCustomer = $this->customerApiModule->create($customer);

            return $this->responder->success($this->customerPayloadMapper->toPayload($createdCustomer));
        });
    }
}
