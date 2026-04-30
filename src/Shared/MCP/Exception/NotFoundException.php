<?php

namespace Codevenom\FakturowniaBundle\Shared\MCP\Exception;

final class NotFoundException extends McpToolException
{
    public function __construct(string $message)
    {
        parent::__construct('not_found', $message);
    }
}
