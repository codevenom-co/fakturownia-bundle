<?php

declare(strict_types=1);

namespace Codevenom\FakturowniaBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

final class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('codevenom_fakturownia');

        $treeBuilder->getRootNode()
            ->children()
            ->scalarNode('base_url')->cannotBeEmpty()->end()
            ->scalarNode('api_token')->cannotBeEmpty()->end()
            ->scalarNode('seller_name')->defaultValue('')->end()
            ->scalarNode('downloads_path')->defaultValue('%kernel.project_dir%/var/fakturownia')->end()
            ->integerNode('timeout')->min(1)->defaultValue(10)->end()
            ->end()
        ;

        return $treeBuilder;
    }
}