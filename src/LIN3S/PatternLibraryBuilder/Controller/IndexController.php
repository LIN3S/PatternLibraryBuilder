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

use LIN3S\PatternLibraryBuilder\Loader\StyleguideConfigLoader;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * @author Gorka Laucirica <gorka.lauzirika@gmail.com>
 * @author Beñat Espiña <benatespina@gmail.com>
 */
class IndexController
{
    private $loader;
    private $twig;
    private $twigFile;

    public function __construct(
        StyleguideConfigLoader $loader,
        \Twig_Environment $twig,
        string $twigFile = '@lin3s_pattern_library_builder/pages/architecture.html.twig'
    ) {
        $this->loader = $loader;
        $this->twig = $twig;
        $this->twigFile = $twigFile;
    }

    public function __invoke(Request $request, string $slug = '') : Response
    {
        if (!$slug) {
            return $this->renderHomepage();
        }

        $itemConfig = $this->loader->get($slug);
        if (!$itemConfig) {
            throw new NotFoundHttpException();
        }

        $media = $request->query->get('media');
        if ($media) {
            $paramsId = $request->query->get('id');

            return $this->renderIFrame($media, $itemConfig, $paramsId);
        }

        return $this->renderItemPage($itemConfig, $slug);
    }

    private function renderHomepage() : Response
    {
        return new Response(
            $this->twig->render('@lin3s_pattern_library_builder/pages/home.html.twig', [
                'menu' => $this->loader->allInHierarchy(),
            ])
        );
    }

    private function renderIFrame($media, $item, $paramsId) : Response
    {
        return new Response($this->twig->render(
            sprintf('@lin3s_pattern_library_builder/pages/iframe/%s.html.twig', $media), [
                'item'      => $item,
                'params_id' => $paramsId,
            ]
        ));
    }

    private function renderItemPage($item, string $slug) : Response
    {
        $twigTemplate = isset($item['template'])
            ? '@lin3s_pattern_library_builder/pages/' . $item['template'] . '.html.twig'
            : $this->twigFile;

        return new Response($this->twig->render($twigTemplate, [
            'item'        => $item,
            'menu'        => $this->loader->allInHierarchy(),
            'breadcrumbs' => $this->generateBreadcrumbs($slug),
        ]));
    }

    private function generateBreadcrumbs($slug) : array
    {
        return explode('/', rtrim($slug, '/'));
    }
}
