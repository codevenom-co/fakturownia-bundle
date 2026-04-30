<?php

namespace Codevenom\FakturowniaBundle\Shared\MCP\Response;

use Codevenom\FakturowniaBundle\Shared\MCP\Serializer\JsonAPIDeserializerManager;
use Mcp\Exception\Exception;

final class McpResponder
{
    public function __construct(
        private readonly JsonAPIDeserializerManager $jsonAPIDeserializerManager,
    ) {
    }

    /**
     * @return array<string, mixed>
     */
    public function success(mixed $payload): array
    {
        return $this->jsonAPIDeserializerManager->Json($payload);
    }

    public function error(Exception|\Throwable $message): array
    {
        return $this->jsonAPIDeserializerManager->throwException($message, $message->getCode());
    }
}
