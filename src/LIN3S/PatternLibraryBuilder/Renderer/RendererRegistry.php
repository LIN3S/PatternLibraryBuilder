<?php

namespace LIN3S\PatternLibraryBuilder\Renderer;

final class RendererRegistry
{
    private $renderers;

    public function add(Renderer $renderer, $name)
    {
        if(isset($this->renderers[$name])) {
            throw new \Exception(sprintf(
                'Renderer with name "%s" already exists',
                $name
            ));
        }

        $this->renderers[$name] = $renderer;
    }

    public function get(string $name): Renderer
    {
        if(!isset($this->renderers[$name])) {
            throw new \Exception(sprintf(
                'Renderer with name "%s" does not exist',
                $name
            ));
        }

        return $this->renderers[$name];
    }
}
