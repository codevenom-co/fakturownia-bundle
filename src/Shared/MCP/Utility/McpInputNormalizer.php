<?php

namespace Codevenom\FakturowniaBundle\Shared\MCP\Utility;

final class McpInputNormalizer
{
    /**
     * @param array<string|int, mixed> $input
     * @return array<string|int, mixed>
     */
    public readonly static function normalize(array $input): array
    {
        if (isset($input[0]) && is_array($input[0]) && count($input) === 1) {
            return $input[0];
        }

        return $input;
    }
}
