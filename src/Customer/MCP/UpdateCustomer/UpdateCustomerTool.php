<?php

namespace Codevenom\FakturowniaBundle\Customer\MCP\UpdateCustomer;

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
    name: 'codevenom.fakturownia.customer.update',
    description: 'Update an existing customer in Fakturownia'
)]
#[AutoconfigureTag('mcp.tool')]
final class UpdateCustomerTool
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
     * @param int $id
     * @param array<string|int, mixed> $client
     * @return array<string, mixed>
     */
    public function __invoke(int $id, array $client): array
    {
        return $this->executor->execute(function () use ($id, $client): array {
            $input = new UpdateCustomerInput($id, McpInputNormalizer::normalize($client));
            $this->inputValidator->validate($input);

            /** @var Customer $customer */
            $customer = $this->customerPayloadMapper->toModel($input->getClientData());
            $customer->setId($input->getId());

            $updatedCustomer = $this->customerApiModule->update($customer);

            return $this->responder->success($this->customerPayloadMapper->toPayload($updatedCustomer));
        });
    }
}
