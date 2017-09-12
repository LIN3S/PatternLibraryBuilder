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

namespace Tests\LIN3S\PatternLibraryBuilder;

use LIN3S\PatternLibraryBuilder\Symfony\Lin3sPatternLibraryBuilderBundle;
use Symfony\Bundle\DebugBundle\DebugBundle;
use Symfony\Bundle\FrameworkBundle\FrameworkBundle;
use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Bundle\TwigBundle\TwigBundle;
use Symfony\Bundle\WebServerBundle\WebServerBundle;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Routing\RouteCollectionBuilder;

/**
 * @author Beñat Espiña <benatespina@gmail.com>
 * @author Gorka Laucirica <gorka.lauzirika@gmail.com>
 */
class AppKernel extends Kernel
{
    use MicroKernelTrait;

    public function registerBundles() : array
    {
        $bundles = [
            new Lin3sPatternLibraryBuilderBundle(),
            new FrameworkBundle(),
            new TwigBundle(),
        ];

        if ('dev' === $this->getEnvironment()) {
            $bundles[] = new WebServerBundle();
            $bundles[] = new DebugBundle();
        }

        return $bundles;
    }

    public function getCacheDir() : string
    {
        return __DIR__ . '/../var/cache/' . $this->getEnvironment();
    }

    public function getLogDir() : string
    {
        return __DIR__ . '/../var/logs';
    }

    protected function configureContainer(ContainerBuilder $container, LoaderInterface $loader) : void
    {
        $container->loadFromExtension('framework', [
            'secret'     => 'sd87cb6cb49c248cn3cnn439cn498ds0210sad2',
            'templating' => [
                'engines' => ['twig'],
            ],
        ])->loadFromExtension('twig', [
            'debug'            => true,
            'strict_variables' => true,
            'paths'            => [
                __DIR__ . '/../templates' => '__main__',
            ],
        ])->loadFromExtension('lin3s_pattern_library_builder', [
            'theme' => [
                'title'         => 'LIN3S',
                'description'   => 'Pattern Library Builder',
                'custom_styles' => [
                    'color_primary' => '#222',
                ],
                'logo' => 'svg/lin3s_logo.svg.twig'
            ],
            'templates_config_files_path' => __DIR__ . '/../src/App/Resources/PatternLibrary',

        ]);
    }

    protected function configureRoutes(RouteCollectionBuilder $routes) : void
    {
        $routes->import(__DIR__ . '/../../../src/LIN3S/PatternLibraryBuilder/Symfony/Resources/config/routing.yml');
    }
}
