<?php

declare(strict_types=1);

namespace Codevenom\FakturowniaBundle\Infrastructure\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

final class CodevenomFakturowniaExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container): void
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $container->setParameter('codevenom_fakturownia.base_url', $config['base_url']);
        $container->setParameter('codevenom_fakturownia.seller_name', $config['seller_name']);
        $container->setParameter('codevenom_fakturownia.api_token', $config['api_token']);
        $container->setParameter('codevenom_fakturownia.timeout', $config['timeout']);

        $loader = new YamlFileLoader($container, new FileLocator(__DIR__.'/../../../config'));
        $loader->load('services.yaml');
    }

    public function getAlias(): string
    {
        return 'codevenom_fakturownia';
    }
}
