<?php

namespace LIN3S\PatternLibraryBuilder\Renderer;

use Symfony\Component\DependencyInjection\Container;

final class RendererRegistry
{
    private $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function get(string $renderer): Renderer
    {
        return $this->container->get(sprintf(
            'lin3s.pattern_library_builder.renderer.%s',
            $renderer
        ));
    }
}
