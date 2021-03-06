<?php

namespace LIN3S\PatternLibraryBuilder\Renderer;

use LIN3S\PatternLibraryBuilder\Config\ThemeConfig;
use Symfony\Component\HttpFoundation\RequestStack;

final class Twig implements Renderer
{
    private $twig;
    private $request;
    private $themeConfig;

    public function __construct(\Twig_Environment $twig, RequestStack $requestStack, ThemeConfig $themeConfig)
    {
        $this->twig = $twig;
        $this->request = $requestStack->getMasterRequest();
        $this->requestStack = $requestStack;
        $this->themeConfig = $themeConfig;
    }

    public function render($item)
    {
        $media = $this->request->query->get('media');

        if ($media) {
            $paramsId = $this->request->query->get('id');

            return $this->renderIFrame($media, $item, $paramsId);
        }

        return $this->renderItemPage($item);
    }

    private function renderItemPage($item)
    {
        return $this->twig->render('@Lin3sPatternLibraryBuilder/renderers/twig.html.twig', [
            'item' => $item['config']['renderer']['options'],
        ]);
    }

    private function renderIFrame($media, $item, $paramsId)
    {
        return $this->twig->render(
            sprintf('@Lin3sPatternLibraryBuilder/pages/iframe/%s.html.twig', $media), [
                'item'      => $item['config']['renderer']['options'],
                'params_id' => $paramsId,
                'theme' => [
                    'title' => $this->themeConfig->title(),
                    'description' => $this->themeConfig->description(),
                    'stylesheets' => $this->themeConfig->stylesheets(),
                    'javascripts' => $this->themeConfig->javascripts(),
                    'customStyles' => $this->themeConfig->customStyles(),
                    'logo' => $this->themeConfig->logo(),
                ],
            ]
        );
    }
}
