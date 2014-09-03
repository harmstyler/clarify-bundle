<?php

namespace HarmsTyler\ClarifyBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('harms_tyler_clarify');

        $rootNode
            ->children()
                ->scalarNode('default_app')->cannotBeEmpty()->defaultValue('default')->end()
                ->arrayNode('apps')
                    ->canBeUnset()
                    ->useAttributeAsKey('name')
                    ->prototype('array')
                        ->addDefaultsIfNotSet()
                        ->children()
                            ->scalarNode('api_key')->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;


        return $treeBuilder;
    }
}
