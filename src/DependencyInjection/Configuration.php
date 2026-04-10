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
                ->scalarNode('base_url')
                    ->info('Pelny URL konta Fakturownia, np. https://twojadomena.fakturownia.pl')
                    ->isRequired()
                    ->cannotBeEmpty()
                ->end()
                ->scalarNode('api_token')
                    ->info('Kod autoryzacyjny API z ustawien Fakturowni')
                    ->isRequired()
                    ->cannotBeEmpty()
                ->end()
                ->integerNode('timeout')
                    ->info('Timeout HTTP w sekundach')
                    ->defaultValue(15)
                    ->min(1)
                ->end()
            ->end();

        return $treeBuilder;
    }
}
