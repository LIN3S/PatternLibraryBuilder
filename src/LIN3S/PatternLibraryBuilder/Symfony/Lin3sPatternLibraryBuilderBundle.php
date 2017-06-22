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

namespace LIN3S\PatternLibraryBuilder\Symfony;

use LIN3S\PatternLibraryBuilder\Symfony\DependencyInjection\Compiler\AddConfigurationValuesToGlobalTwigVariablesPass;
use LIN3S\PatternLibraryBuilder\Symfony\DependencyInjection\Compiler\CustomizeThemePass;
use LIN3S\PatternLibraryBuilder\Symfony\DependencyInjection\Compiler\SetTemplatesConfigFilesPathPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * @author Beñat Espiña <benatespina@gmail.com>
 */
class Lin3sPatternLibraryBuilderBundle extends Bundle
{
    public function build(ContainerBuilder $container) : void
    {
        $container->loadFromExtension('twig', [
            'paths'   => [
                $this->basePath() . '/templates' => 'Lin3sPatternLibraryBuilder',
            ],
            'globals' => [
                'assets_path' => '/bundles/lin3spatternlibrarybuilder',
            ],
        ]);

        $container->addCompilerPass(new AddConfigurationValuesToGlobalTwigVariablesPass());
        $container->addCompilerPass(new SetTemplatesConfigFilesPathPass());
        $container->addCompilerPass(new CustomizeThemePass());
    }

    private function basePath() : string
    {
        $directory = dirname((new \ReflectionClass(self::class))->getFileName());

        return $directory . '/../Resources';
    }
}
