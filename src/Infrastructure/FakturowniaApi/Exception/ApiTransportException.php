<?php

declare(strict_types=1);

namespace Codevenom\FakturowniaBundle\Infrastructure\FakturowniaApi\Exception;

final class ApiTransportException extends \RuntimeException
{
    public function __construct(string $message, ?\Throwable $previous = null)
    {
        parent::__construct($message, 0, $previous);
    }
}
