<?php

namespace Codevenom\FakturowniaBundle\Customer\MCP\DeleteCustomer;

use Codevenom\FakturowniaBundle\Customer\CustomerApiModuleInterface;
use Codevenom\FakturowniaBundle\Shared\MCP\McpToolExecutor;
use Codevenom\FakturowniaBundle\Shared\MCP\Response\McpResponder;
use Codevenom\FakturowniaBundle\Shared\MCP\Validation\McpInputValidator;
use Mcp\Capability\Attribute\McpTool;
use Symfony\Component\DependencyInjection\Attribute\AutoconfigureTag;

#[McpTool(
    name: 'codevenom.fakturownia.customer.delete',
    description: 'Delete a customer from Fakturownia'
)]
#[AutoconfigureTag('mcp.tool')]
final class DeleteCustomerTool
{
    public function __construct(
        private CustomerApiModuleInterface $customerApiModule,
        private McpResponder              $responder,
        private McpToolExecutor           $executor,
        private McpInputValidator         $inputValidator,
    ) {
    }

    public function __invoke(int $id): array
    {
        return $this->executor->execute(function () use ($id): array {
            $input = new DeleteCustomerInput($id);
            $this->inputValidator->validate($input);

            $this->customerApiModule->delete($input->getId());

            return $this->responder->success(['status' => 'success', 'message' => sprintf('Customer with ID %d deleted successfully.', $id)]);
        });
    }
}
