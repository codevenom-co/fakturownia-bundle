<?php

namespace Codevenom\FakturowniaBundle\Customer\MCP\FindCustomerById;

use Codevenom\FakturowniaBundle\Customer\CustomerManagerInterface;
use Codevenom\FakturowniaBundle\Customer\Mapper\CustomerPayloadMapper;
use Codevenom\FakturowniaBundle\Shared\MCP\McpToolExecutor;
use Codevenom\FakturowniaBundle\Shared\MCP\Response\McpResponder;
use Codevenom\FakturowniaBundle\Shared\MCP\Validation\McpInputValidator;
use Mcp\Capability\Attribute\McpTool;
use Symfony\Component\DependencyInjection\Attribute\AutoconfigureTag;

#[McpTool(
    name: 'codevenom.fakturownia.customer.find_by_id',
    description: 'Finds a customer by their ID and returns full customer details.'
)]
#[AutoconfigureTag('mcp.tool')]
final class FindCustomerByIdTool
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
     * @return array<string, mixed>
     */
    public function __invoke(int $id): array
    {
        return $this->executor->execute(function () use ($id): array {
            $input = new FindCustomerByIdInput($id);

            $this->inputValidator->validate($input);

            $customer = $this->customerManager->findById($input->getId());

            return $this->responder->success($this->customerPayloadMapper->toPayload($customer));
        });
    }
}
