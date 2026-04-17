<?php

declare(strict_types=1);

namespace Codevenom\FakturowniaBundle\Tests\App;

use Codevenom\FakturowniaBundle\CodevenomFakturowniaBundle;
use Symfony\Bundle\FrameworkBundle\FrameworkBundle;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\HttpKernel\Kernel;

final class TestKernel extends Kernel
{
    public function registerBundles(): iterable
    {
        return [
            new FrameworkBundle(),
            new CodevenomFakturowniaBundle(),
        ];
    }

    public function registerContainerConfiguration(LoaderInterface $loader): void
    {
        $confDir = __DIR__.'/config';

        $loader->load($confDir.'/packages/*.yaml', 'glob');
        $loader->load($confDir.'/services.yaml');
        $loader->load($confDir.'/services_test.yaml');
    }

    public function getLogDir(): string
    {
        return sys_get_temp_dir().'/FakturowniaBundle/logs';
    }
}