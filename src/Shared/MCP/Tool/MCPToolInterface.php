<?php

namespace Codevenom\FakturowniaBundle\Shared\MCP\Tool;

interface MCPToolInterface
{
    public function name(): string;

    /**
     * JSON-schema-like array describing tool input.
     * Keep it simple for now (type/properties/required).
     *
     * @return array<string, mixed>
     */
    public function inputSchema(): array;

    /**
     * @param array<string, mixed> $arguments
     * @return array<string, mixed> JSON-serializable
     */
    public function call(array $arguments): array;
}