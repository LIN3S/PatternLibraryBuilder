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

namespace LIN3S\PatternLibraryBuilder\Symfony\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * @author Gorka Laucirica <gorka.lauzirika@gmail.com>
 */
class LoadThemeConfigPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        if (!$container->hasDefinition('twig')) {
            return;
        }

        $config = $container->getParameter('lin3s_pattern_library_builder.config');

        $container->getDefinition('lin3s.pattern_library_builder.config.theme')
            ->replaceArgument(0, $config['theme']['title'])
            ->replaceArgument(1, $config['theme']['description'])
            ->replaceArgument(2, $config['theme']['stylesheets'])
            ->replaceArgument(3, $config['theme']['javascripts'])
            ->replaceArgument(4, $config['theme']['custom_styles'])
            ->replaceArgument(5, $config['theme']['logo']);
    }
}
