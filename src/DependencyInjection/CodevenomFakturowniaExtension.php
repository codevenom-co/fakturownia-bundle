<?php

declare(strict_types=1);

namespace Codevenom\FakturowniaBundle\DependencyInjection;

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

        $container->setParameter('codevenom_fakturownia.base_url', $config['base_url'] ?? 'https://app.fakturownia.pl');
        $container->setParameter('codevenom_fakturownia.api_token', $config['api_token'] ?? '');
        $container->setParameter('codevenom_fakturownia.seller_name', $config['seller_name'] ?? '');
        $container->setParameter('codevenom_fakturownia.seller_tax_id', $config['seller_tax_id'] ?? '');
        $container->setParameter('codevenom_fakturownia.downloads_path', $config['downloads_path'] ?? '%kernel.project_dir%/var/fakturownia');
        $container->setParameter('codevenom_fakturownia.timeout', $config['timeout'] ?? 30);

        if ($container->hasParameter('mcp.discovery.scan_dirs')) {
            $scanDirs = $container->getParameter('mcp.discovery.scan_dirs');
            $bundleSrc = 'vendor/codevenom/fakturownia-bundle/src';
            if (!in_array($bundleSrc, $scanDirs)) {
                $scanDirs[] = $bundleSrc;
                $container->setParameter('mcp.discovery.scan_dirs', $scanDirs);
            }
        }

        $loader = new YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('services.yaml');
    }
}