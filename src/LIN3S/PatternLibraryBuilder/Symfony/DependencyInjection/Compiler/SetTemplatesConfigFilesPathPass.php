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
 * @author Beñat Espiña <benatespina@gmail.com>
 */
class SetTemplatesConfigFilesPathPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        if (!$container->hasDefinition('lin3s.pattern_library_builder.loader.styleguide_config_loader')) {
            return;
        }

        $config = $container->getParameter('lin3s_pattern_library_builder.config');
        $templateConfigFilesPath = $config['templates_config_files_path'];

        $container->getDefinition('lin3s.pattern_library_builder.loader.styleguide_config_loader')
            ->setArguments([$templateConfigFilesPath]);
    }
}
