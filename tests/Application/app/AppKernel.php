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
            'paths' => [
                __DIR__ . '/../templates' => '__main__',
            ],
        ])->loadFromExtension('lin3s_pattern_library_builder', [
            'title'                       => 'Test pattern library',
            'description'                 => 'This is the testing purposes pattern library',
            'templates_config_files_path' => __DIR__ . '/../src/App/Resources/PatternLibrary',
            'iconography'                 => [
                'path'           => __DIR__ . '/../templates/svg',
                'twig_namespace' => 'svg',
            ],
            'theme'                       => [
                'color_primary'                                 => '#0099ff',
                'font_family_primary'                           => 'Open Sans',
                'font_family_secondary'                         => 'Roboto',
                'article_background_color'                      => '#fefefe',
                'aside_background_color'                        => '#e1e1e1',
                'aside_header_background_color'                 => '#0099ff',
                'aside_header_text_color'                       => '#fff',
                'accordion_item_level1_text_color'              => '#333',
                'accordion_item_level1_text_color_hover'        => '#545454',
                'accordion_item_level1_background_color_opened' => '#ececec',
                'accordion_item_level1_header_border_color'     => '#d1d1d1',
                'accordion_item_level2_text_color'              => '#666',
                'accordion_item_level2_text_color_hover'        => '#999',
                'accordion_item_level2_background_color_opened' => '#f8fbfb',
                'accordion_item_level2_header_border_color'     => '#e5e5e5',
                'accordion_item_level3_text_color'              => '#999',
                'accordion_item_level3_text_color_hover'        => '#a3a3a3',
                'accordion_item_level3_background_color'        => '#fff',
                'status_text_color_todo'                        => '#f14133',
                'status_text_color_doing'                       => '#fba30a',
                'status_text_color_pending_review'              => '#16a5ba',
                'status_text_color_done'                        => '#598d09',
                'tabbed_background_color'                       => '',
                'tabbed_border_color'                           => '',
                'tabbed_content_background_color'               => '',
                'tabbed_content_border_color'                   => '',
                'breadcrumbs_text_color'                        => '#b6b6b6',
                'title_text_color'                              => '#0099ff',
                'description_text_color'                        => '#444',
                'form_input_border_color'                       => '#b0b0b0',
                'form_input_border_color_hover'                 => '#0099ff',
                'form_label_text_color'                         => '#444',
                'icon_fill_color'                               => '#0099ff',
            ],
        ]);
    }

    protected function configureRoutes(RouteCollectionBuilder $routes) : void
    {
        $routes->import(__DIR__ . '/../../../src/LIN3S/PatternLibraryBuilder/Symfony/Resources/config/routing.yml');
    }
}
