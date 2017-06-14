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

use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
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

        $themeArrayNode = new ArrayNodeDefinition('theme');

        $treeBuilder->root('lin3s_pattern_library_builder')
            ->children()
                ->scalarNode('title')
                    ->isRequired()
                ->end()
                ->scalarNode('description')
                    ->defaultValue('')
                ->end()
                ->append($this->themeProperties($themeArrayNode))
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
        'font_family_primary',
        'font_family_secondary',
        'article_background_color',
        'aside_background_color',
        'aside_header_background_color',
        'aside_header_text_color',
        'accordion_item_level1_text_color',
        'accordion_item_level1_text_color_hover',
        'accordion_item_level1_background_color_opened',
        'accordion_item_level1_header_border_color',
        'accordion_item_level2_text_color',
        'accordion_item_level2_text_color_hover',
        'accordion_item_level2_background_color_opened',
        'accordion_item_level2_header_border_color',
        'accordion_item_level3_text_color',
        'accordion_item_level3_text_color_hover',
        'accordion_item_level3_background_color',
        'status_text_color_todo',
        'status_text_color_doing',
        'status_text_color_pending_review',
        'status_text_color_done',
        'tabbed_background_color',
        'tabbed_border_color',
        'tabbed_content_background_color',
        'tabbed_content_border_color',
        'breadcrumbs_text_color',
        'title_text_color',
        'description_text_color',
        'form_input_border_color',
        'form_input_border_color_hover',
        'form_label_text_color',
        'icon_fill_color',
    ];
}
