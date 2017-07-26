<?php

namespace LIN3S\PatternLibraryBuilder\Renderer;

final class Typography implements Renderer
{
    private $twig;

    public function __construct(\Twig_Environment $twig)
    {
        $this->twig = $twig;
    }

    public function render($item)
    {
        return $this->twig->render('@Lin3sPatternLibraryBuilder/renderers/typography.html.twig', [
            'typographies' => $item['config']['renderer']['options']['typographies'],
        ]);
    }
}
