<?php

/*
 * This file is part of the Pattern Library Builder project.
 *
 * Copyright (c) 2017-present LIN3S <info@lin3s.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace LIN3S\PatternLibraryBuilder\Symfony\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * @author Beñat Espiña <benatespina@gmail.com>
 */
class CustomizeThemePass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        if (!$container->hasDefinition('twig')) {
            return;
        }

        $config = $container->getParameter('lin3s_pattern_library_builder.config');
        $themeData = $config['theme'];

        $theme = sprintf(
            self::THEME,
            $themeData['accordion']['default'],
            $themeData['accordion']['hover'],
            $themeData['accordion']['open'],
            $themeData['accordion']['header'],
            $themeData['accordion']['link']['default'],
            $themeData['accordion']['link']['hover'],
            '',
            '',
            '',
            '',
            '',
            '',
            '',
            '',
            '',
            '',
            $themeData['tab'],
            $themeData['main']['aside'],
            $themeData['main']['article'],
            $themeData['accordion']['icon']
        );

        $container->getDefinition('twig')->addMethodCall('addGlobal', ['theme_styles', $theme]);
    }

    const THEME = '.accordion-item{color:%s}.accordion-item:hover{color:%s}' .
    '.accordion-item.accordion-item--opened{background-color:%s}' .
    '.accordion-item .accordion-item__header{border-color:%s}.accordion-item .link{color:%s}' .
    '.accordion-item .link:hover{color:%s}.accordion-item .accordion-item{color:%s}' .
    '.accordion-item .accordion-item:hover{color:%s}' .
    '.accordion-item .accordion-item.accordion-item--opened{background-color:%s}' .
    '.accordion-item .accordion-item .accordion-item__header{border-color:%s}' .
    '.accordion-item--leaf .accordion-item{color:%s}.accordion-item--leaf .accordion-item:hover{color:%s}' .
    '.accordion-item--leaf .accordion-item.accordion-item--opened{background-color:%s}' .
    '.accordion-item--leaf .accordion-item .accordion-item__header{border-color:%s}' .
    '.accordion-item--leaf .accordion-item .link{color:%s}.accordion-item--leaf .accordion-item .link:hover{color:%s}' .
    '.tabbed__nav-item::after{background-color:%s}.main__aside{background-color:%s}' .
    '.main__article{background-color:%s}.icon-plus{fill:%s}';
}
