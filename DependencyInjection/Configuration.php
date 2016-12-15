<?php

namespace Cube\RedactorBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('cube_redactor');

        $rootNode
            ->useAttributeAsKey('id')
            ->prototype('array')
                ->children()
                    ->arrayNode('settings')
                        ->info('Redactor settings, see http://imperavi.com/redactor/docs/settings/')
                        ->children()
                            ->scalarNode('lang')->example('en')->end()
                            ->scalarNode('minHeight')->example(200)->end()
                            ->booleanNode('clickToEdit')->example('false')->end()
                            ->scalarNode('clickToCancel')->example('#btn-cancel')->end()
                            ->scalarNode('clickToSave')->example('#btn-save')->end()
                            ->scalarNode('inlineSaveCallback')
                                ->example('saveCallback')
                                ->info('Name of JS callback function, should be in "window" NS')
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end();

        return $treeBuilder;
    }
}
