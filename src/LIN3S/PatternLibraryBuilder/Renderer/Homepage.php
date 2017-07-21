<?php

namespace LIN3S\PatternLibraryBuilder\Renderer;

class Homepage implements Renderer
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
        return $this->twig->render('@Lin3sPatternLibraryBuilder/renderers/homepage.html.twig', [
            'sections' => $item['renderer']['options']['sections'],
        ]);
    }
}
