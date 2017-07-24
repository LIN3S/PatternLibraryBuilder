<?php

namespace LIN3S\PatternLibraryBuilder\Renderer;

use LIN3S\PatternLibraryBuilder\Config\ConfigLoader;

class Homepage implements Renderer
{
    private $twig;
    private $config;

    public function __construct(\Twig_Environment $twig, ConfigLoader $configLoader)
    {
        $this->twig = $twig;
        $this->config = $configLoader->loadConfig();
    }

    public function render($item)
    {
        $sections = $item['config']['renderer']['options']['sections'];

        $sections = array_map(function($section) {
            $items = [];
            foreach ($section['items'] as $item) {
                $item['config'] = $this->config->get($item['slug']);
                $items[] = $item;
            }
            $section['items'] = $items;

            return $section;
        }, $sections);

        return $this->twig->render('@Lin3sPatternLibraryBuilder/renderers/homepage.html.twig', [
            'sections' => $sections,
        ]);
    }
}
