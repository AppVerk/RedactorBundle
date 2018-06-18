<?php

namespace AppVerk\RedactorBundle\DependencyInjection;

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
        $rootNode = $treeBuilder->root('redactor');

        $rootNode
            ->useAttributeAsKey('id')
            ->prototype('array')
                ->children()
                    ->arrayNode('settings')
                        ->info('Redactor settings, see http://imperavi.com/redactor/docs/settings/')
                        ->children()
                            ->scalarNode('lang')->example('en')->end()
                            ->scalarNode('focus')->example('false')->end()
                            ->scalarNode('minHeight')->example(200)->end()
                            ->scalarNode('toolbarFixedTopOffset')->example(0)->end()
                            ->scalarNode('toolbarFixed')->example(true)->end()
                            ->scalarNode('toolbarExternal')->example('#your-toolbar-layer-id')->end()
                            ->scalarNode('placeholder')->example('type text...')->end()
                            ->booleanNode('air')->example('false')->end()
                            ->booleanNode('clickToEdit')->example('false')->end()
                            ->scalarNode('clickToCancel')->example('#btn-cancel')->end()
                            ->scalarNode('clickToSave')->example('#btn-save')->end()
                            ->arrayNode('plugins')
                                ->prototype('scalar')
                                ->end()
                            ->end()
                            ->arrayNode('pasteInlineTags')
                                ->prototype('scalar')
                                ->end()
                            ->end()
                            ->scalarNode('imageUpload')->example('/redactor/upload')->end()
                            ->scalarNode('imageManagerJson')->example('/redactor/image-manager')->end()
                            ->scalarNode('inlineSaveCallback')
                                ->example('saveCallback')
                                ->info('Name of JS callback function, should be in "window" NS')
                            ->end()
                            ->arrayNode('formatting')
                                ->prototype('scalar')
                                ->end()
                            ->end()
                            ->arrayNode('buttons')
                                ->prototype('scalar')
                                ->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end();

        return $treeBuilder;
    }
}
