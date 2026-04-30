<?php

namespace Codevenom\FakturowniaBundle\Shared\MCP\Validation;

use Codevenom\FakturowniaBundle\Shared\MCP\Exception\InvalidArgumentsException;
use Symfony\Component\Validator\Validator\ValidatorInterface;

final class McpInputValidator
{
    public function __construct(
        private readonly ValidatorInterface $validator,
    ) {}

    public function validate(object $input): void
    {
        $violations = $this->validator->validate($input);

        if (0 === $violations->count()) {
            return;
        }

        $messages = [];

        foreach ($violations as $violation) {
            $propertyPath = $violation->getPropertyPath();

            $messages[] = $propertyPath === ''
                ? $violation->getMessage()
                : sprintf('%s: %s', $propertyPath, $violation->getMessage());
        }

        throw new InvalidArgumentsException(implode(' ', $messages));
    }
}
