<?php

namespace Codevenom\FakturowniaBundle\Shared\MCP\Exception;

final class InvalidArgumentsException extends McpToolException
{
    public function __construct(string $message)
    {
        parent::__construct('invalid_arguments', $message);
    }
}
