<?php

namespace Codevenom\FakturowniaBundle\Shared\MCP\Exception;

abstract class McpToolException extends \Exception
{
    public function __construct(
        private readonly string $errorCode,
        string $message,
    ) {
        parent::__construct($message);
    }

    public function getErrorCode(): string
    {
        return $this->errorCode;
    }
}
