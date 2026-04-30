<?php

namespace Codevenom\FakturowniaBundle\Shared\MCP;

use Codevenom\FakturowniaBundle\Shared\MCP\Exception\McpToolException;
use Codevenom\FakturowniaBundle\Shared\MCP\Response\McpResponder;

final readonly class McpToolExecutor
{
    public function __construct(
        private McpResponder $responder,
    ) {}

    /**
     * @param callable(): array<string, mixed> $callback
     *
     * @return array<string, mixed>
     */
    public function execute(callable $callback): array
    {
        try {
            return $callback();
        } catch (McpToolException $exception) {
            return $this->responder->error($exception);
        }
    }
}
