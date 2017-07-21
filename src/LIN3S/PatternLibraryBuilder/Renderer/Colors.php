<?php

namespace LIN3S\PatternLibraryBuilder\Renderer;

final class Colors implements Renderer
{
    private $twig;

    public function __construct(\Twig_Environment $twig)
    {
        $this->twig = $twig;
    }

    public function renderPreview($item)
    {
    }

    public function renderFull($item)
    {
        return $this->twig->render('@Lin3sPatternLibraryBuilder/renderers/colors.html.twig', [
            'colors' => $item['renderer']['options']['colors'],
        ]);
    }
}
