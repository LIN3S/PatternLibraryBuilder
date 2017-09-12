<?php

/*
 * This file is part of the Pattern Library Builder library.
 *
 * Copyright (c) 2017-present LIN3S <info@lin3s.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace LIN3S\PatternLibraryBuilder\Symfony\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * @author Beñat Espiña <benatespina@gmail.com>
 * @author Gorka Laucirica <gorka.lauzirika@gmail.com>
 */
class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();

        $themeArrayNode = new ArrayNodeDefinition('custom_styles');

        $treeBuilder->root('lin3s_pattern_library_builder')
            ->children()
                ->arrayNode('theme')
                    ->children()
                        ->scalarNode('title')
                            ->isRequired()
                        ->end()
                        ->scalarNode('logo')->end()
                        ->scalarNode('description')
                            ->defaultValue('')
                        ->end()
                        ->arrayNode('stylesheets')
                            ->prototype('scalar')->end()
                            ->defaultValue([])
                        ->end()
                        ->arrayNode('javascripts')
                            ->prototype('scalar')->end()
                            ->defaultValue([])
                        ->end()
                        ->append($this->themeProperties($themeArrayNode))
                    ->end()
                ->end()

                ->scalarNode('templates_config_files_path')
                    ->isRequired()
                ->end()
            ->end();

        return $treeBuilder;
    }

    private function themeProperties(ArrayNodeDefinition $themeNode) : ArrayNodeDefinition
    {
        $children = $themeNode->children();

        foreach (self::THEME_PROPERTIES as $property) {
            $children
                ->scalarNode($property)
                    ->defaultValue('inherit')
                ->end();
        }

        $themeNode->end();

        return $themeNode;
    }

    const THEME_PROPERTIES = [
        'color_primary',
    ];
}
