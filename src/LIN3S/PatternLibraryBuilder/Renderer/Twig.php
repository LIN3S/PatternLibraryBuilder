<?php

namespace LIN3S\PatternLibraryBuilder\Renderer;

use Symfony\Component\HttpFoundation\RequestStack;

final class Twig implements Renderer
{
    private $twig;
    private $request;

    public function __construct(\Twig_Environment $twig, RequestStack $requestStack)
    {
        $this->twig = $twig;
        $this->request = $requestStack->getMasterRequest();
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
            'item' => $item['renderer']['options'],
        ]);
    }

    private function renderIFrame($media, $item, $paramsId)
    {
        return $this->twig->render(
            sprintf('@Lin3sPatternLibraryBuilder/pages/iframe/%s.html.twig', $media), [
                'item'      => $item['renderer']['options'],
                'params_id' => $paramsId,
            ]
        );
    }
}
