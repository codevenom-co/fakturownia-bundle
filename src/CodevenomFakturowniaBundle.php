<?php

declare(strict_types=1);

namespace Codevenom\FakturowniaBundle;

use Codevenom\FakturowniaBundle\Infrastructure\DependencyInjection\CodevenomFakturowniaExtension;
use Symfony\Component\DependencyInjection\Extension\ExtensionInterface;
use Symfony\Component\HttpKernel\Bundle\Bundle;

final class CodevenomFakturowniaBundle extends Bundle
{
    public function getContainerExtension(): ?ExtensionInterface
    {
        return new CodevenomFakturowniaExtension();
    }
}