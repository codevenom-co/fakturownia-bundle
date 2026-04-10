<?php

declare(strict_types=1);

namespace Codevenom\FakturowniaBundle\Infrastructure\FakturowniaApi\Exception;

final class ApiResponseException extends \RuntimeException
{
    public function __construct(
        string $message,
        private readonly int $statusCode,
        private readonly array $payload = [],
        ?\Throwable $previous = null,
    ) {
        parent::__construct($message, $statusCode, $previous);
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    public function getPayload(): array
    {
        return $this->payload;
    }
}
