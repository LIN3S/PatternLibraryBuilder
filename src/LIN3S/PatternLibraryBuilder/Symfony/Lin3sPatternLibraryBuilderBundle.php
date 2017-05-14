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

namespace LIN3S\PatternLibraryBuilder\Symfony;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * @author Beñat Espiña <benatespina@gmail.com>
 */
class Lin3sPatternLibraryBuilderBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        $container->loadFromExtension('twig', [
            'paths' => [
                $this->basePath() . '/templates' => 'lin3s_pattern_library_builder',
            ],
        ]);
    }

    private function basePath()
    {
        $directory = dirname((new \ReflectionClass(self::class))->getFileName());

        return $directory . '/../Resources';
    }
}
