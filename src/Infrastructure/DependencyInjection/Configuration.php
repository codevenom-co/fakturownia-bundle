<?php

declare(strict_types=1);

namespace Codevenom\FakturowniaBundle\Infrastructure\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

final class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('codevenom_fakturownia');

        $treeBuilder->getRootNode()
            ->children()
            ->scalarNode('base_url')->defaultValue('https://example.test')->end()
            ->scalarNode('seller_name')->defaultValue('')->end()
            ->scalarNode('api_token')->defaultValue('')->end()
            ->integerNode('timeout')->defaultValue(5)->end()
            ->end()
        ;

        return $treeBuilder;
    }
}