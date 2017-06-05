<?php

declare(strict_types=1);

/*
 * This file is part of the Pattern Library Builder project.
 *
 * Copyright (c) 2017-present LIN3S <info@lin3s.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LIN3S\PatternLibraryBuilder\Symfony\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * @author Beñat Espiña <benatespina@gmail.com>
 */
class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();

        $treeBuilder->root('lin3s_pattern_library_builder')
            ->children()
                ->scalarNode('title')
                    ->isRequired()
                ->end()
                ->scalarNode('description')
                    ->defaultValue('')
                ->end()
                ->arrayNode('theme')
                    ->children()
                        ->arrayNode('accordion')->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('default')
                                    ->defaultValue('inherit')
                                ->end()
                                ->scalarNode('hover')
                                    ->defaultValue('inherit')
                                ->end()
                                ->scalarNode('open')
                                    ->defaultValue('inherit')
                                ->end()
                                ->scalarNode('header')
                                    ->defaultValue('inherit')
                                ->end()
                                ->arrayNode('link')
                                    ->children()
                                        ->scalarNode('default')
                                            ->defaultValue('inherit')
                                        ->end()
                                        ->scalarNode('hover')
                                            ->defaultValue('inherit')
                                        ->end()
                                    ->end()
                                ->end()
                                ->scalarNode('icon')
                                    ->defaultValue('inherit')
                                ->end()
                            ->end()
                        ->end()
                        ->scalarNode('tab')
                            ->defaultValue('inherit')
                        ->end()
                        ->arrayNode('main')->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('aside')
                                    ->defaultValue('inherit')
                                ->end()
                                ->scalarNode('article')
                                    ->defaultValue('inherit')
                                ->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end();

        return $treeBuilder;
    }
}
