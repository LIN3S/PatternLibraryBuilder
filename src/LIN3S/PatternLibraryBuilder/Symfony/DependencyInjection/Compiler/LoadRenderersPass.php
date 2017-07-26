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
use Symfony\Component\DependencyInjection\Reference;

/**
 * @author Gorka Laucirica <gorka.lauzirika@gmail.com>
 */
class LoadRenderersPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        if (!$container->hasDefinition('lin3s.pattern_library_builder.renderer.registry')) {
            return;
        }

        $definition = $container->getDefinition('lin3s.pattern_library_builder.renderer.registry');

        $taggedServices = $container->findTaggedServiceIds('lin3s.pattern_library_builder.renderer');

        foreach ($taggedServices as $id => $tags) {
            foreach ($tags as $attributes) {
                if(!isset($attributes['alias'])) {
                    throw new \Exception(sprintf(
                        'Alias parameter not found in %s service definition tagged with lin3s.pattern_library_builder.renderer',
                        $id
                    ));
                }
                $definition->addMethodCall('add', array(new Reference($id), $attributes['alias']));
            }
        }
    }
}
