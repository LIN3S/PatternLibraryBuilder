<?php

namespace LIN3S\PatternLibraryBuilder\Renderer;

use SplFileInfo;
use Symfony\Component\Finder\Finder;

final class Iconography implements Renderer
{
    private $twig;

    public function __construct(\Twig_Environment $twig)
    {
        $this->twig = $twig;
    }

    public function render($item)
    {
        $folders = $item['config']['renderer']['options']['folders'];
        
        return $this->twig->render('@Lin3sPatternLibraryBuilder/renderers/iconography.html.twig', [
            'icons' => $this->findIcons($folders)
        ]);
    }

    public function findIcons(array $folders): array
    {
        $icons = [];

        foreach($folders as $folder) {
            $finder = new Finder();
            $files = $finder->directories()->in($folder['path'])->files();

            foreach ($files as $file) {
                $icons[] = [
                    'name' => $this->iconName($file),
                    'twig_namespace' => $folder['twig_namespace']
                ];
            }
        }

        return $icons;
    }

    private function iconName(SplFileInfo $file): string
    {
        $svgFileName = pathinfo($file->getFilename(), PATHINFO_FILENAME);

        return pathinfo($svgFileName, PATHINFO_FILENAME);
    }
}
