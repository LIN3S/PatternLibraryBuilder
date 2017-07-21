<?php

namespace LIN3S\PatternLibraryBuilder\Renderer;

final class Iconography implements Renderer
{
    private $twig;

    public function __construct(\Twig_Environment $twig)
    {
        $this->twig = $twig;
    }

    public function renderPreview($item)
    {
        // TODO: Implement renderPreview() method.
    }

    public function renderFull($item)
    {
        return $this->twig->render('@Lin3sPatternLibraryBuilder/renderers/iconography.html.twig');
    }
}
