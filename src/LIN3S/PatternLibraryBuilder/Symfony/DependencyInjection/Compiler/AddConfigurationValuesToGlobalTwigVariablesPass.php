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

namespace LIN3S\PatternLibraryBuilder\Symfony\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * @author Beñat Espiña <benatespina@gmail.com>
 */
class AddConfigurationValuesToGlobalTwigVariablesPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        if (!$container->hasDefinition('twig')) {
            return;
        }

        $config = $container->getParameter('lin3s_pattern_library_builder.config');

        $container->getDefinition('twig')
            ->addMethodCall('addGlobal', ['title', $config['title']])
            ->addMethodCall('addGlobal', ['description', $config['description']]);
    }
}
