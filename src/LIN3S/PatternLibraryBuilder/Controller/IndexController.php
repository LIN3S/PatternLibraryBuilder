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

namespace LIN3S\PatternLibraryBuilder\Controller;

use LIN3S\PatternLibraryBuilder\Config\ConfigLoader;
use LIN3S\PatternLibraryBuilder\Config\ThemeConfig;
use LIN3S\PatternLibraryBuilder\Renderer\RendererRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * @author Gorka Laucirica <gorka.lauzirika@gmail.com>
 * @author Beñat Espiña <benatespina@gmail.com>
 */
final class IndexController
{
    private $loader;
    private $themeConfig;
    private $rendererRegistry;
    private $twig;

    public function __construct(
        ConfigLoader $loader,
        ThemeConfig $themeConfig,
        RendererRegistry $rendererRegistry,
        \Twig_Environment $twig
    ) {
        $this->loader = $loader;
        $this->themeConfig = $themeConfig;
        $this->rendererRegistry = $rendererRegistry;
        $this->twig = $twig;
    }

    public function __invoke(Request $request, string $slug = '') : Response
    {
        $config = $this->loader->loadConfig();

        $item = $config->get($slug);

        if (!$item) {
            throw new NotFoundHttpException();
        }

        $renderer = $this->rendererRegistry->get($item['config']['renderer']['type']);

        $content = $renderer->render($item);

        if($request->query->has('content_only')) {
            return new Response($content);
        }

        return new Response($this->twig->render('@Lin3sPatternLibraryBuilder/pattern_library.html.twig', [
            'theme' => $this->themeConfig,
            'menu' => $config->allInHierarchy(),
            'breadcrumbs' => $this->generateBreadcrumbs($slug),
            'content' => $content,
            'item' => $item['config']
        ]));
    }

    private function generateBreadcrumbs($slug) : array
    {
        return explode('/', rtrim($slug, '/'));
    }
}
