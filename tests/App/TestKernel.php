<?php

declare(strict_types=1);

namespace Codevenom\FakturowniaBundle\Tests\App;

use Codevenom\FakturowniaBundle\CodevenomFakturowniaBundle;
use Codevenom\FakturowniaBundle\Domain\Event\DomainEventDispatcherInterface;
use Codevenom\FakturowniaBundle\Infrastructure\DependencyInjection\CodevenomFakturowniaExtension;
use Codevenom\FakturowniaBundle\Infrastructure\FakturowniaApi\Event\InMemoryDomainEventDispatcher;
use Symfony\Bundle\FrameworkBundle\FrameworkBundle;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
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
        $loader->load(function (ContainerBuilder $container) {
            $container->registerExtension(new CodevenomFakturowniaExtension());

            $container->loadFromExtension('framework', [
                'secret' => 'test_secret',
                'test' => true,
                'http_client' => [
                    'enabled' => true,
                ],
            ]);

            $baseUrl = $_SERVER['FAKTUROWNIA_BASE_URL']
                ?? $_ENV['FAKTUROWNIA_BASE_URL']
                ?? 'https://example.test';

            $apiToken = $_SERVER['FAKTUROWNIA_API_TOKEN']
                ?? $_ENV['FAKTUROWNIA_API_TOKEN']
                ?? 'test_token';

            $sellerName = $_SERVER['FAKTUROWNIA_SELLER_NAME']
                ?? $_ENV['FAKTUROWNIA_SELLER_NAME']
                ?? 'test_seller';

            $container->loadFromExtension('codevenom_fakturownia', [
                'base_url' => $baseUrl,
                'seller_name' => $sellerName,
                'api_token' => $apiToken,
                'timeout' => 5,
            ]);

            // Test-only domain event dispatcher (so Application handlers can autowire it)
            $container->register(InMemoryDomainEventDispatcher::class, InMemoryDomainEventDispatcher::class)
                ->setPublic(true);

            $container->setAlias(DomainEventDispatcherInterface::class, InMemoryDomainEventDispatcher::class)
                ->setPublic(true);
        });
    }

    public function getLogDir(): string
    {
        return sys_get_temp_dir().'/FakturowniaBundle/logs';
    }
}