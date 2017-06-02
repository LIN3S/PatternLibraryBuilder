<?php

/*
 * This file is part of the Pattern Library Builder project.
 *
 * Copyright (c) 2017-present LIN3S <info@lin3s.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

/*
 * This file is part of the Pattern Library Builder project.
 *
 * Copyright (c) 2017-present LIN3S <info@lin3s.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LIN3S\PatternLibraryBuilder\Controller;

use Symfony\Component\Finder\Finder;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Yaml\Yaml;

/**
 * @author Gorka Laucirica <gorka.lauzirika@gmail.com>
 * @author Beñat Espiña <benatespina@gmail.com>
 */
class IndexController
{
    private $itemsPath;
    private $prefixPath;
    private $twig;
    private $twigFile;

    public function __construct(
        string $itemsPath,
        \Twig_Environment $twig,
        string $twigFile = '@lin3s_pattern_library_builder/pattern_library.html.twig',
        string $prefixPath = '/design-system'
    ) {
        $this->itemsPath = $itemsPath;
        $this->prefixPath = $prefixPath;
        $this->twig = $twig;
        $this->twigFile = $twigFile;
    }

    public function __invoke(string $slug = ''): Response
    {
        if (!$slug) {
            return new Response($this->twig->render($this->twigFile, [
                'menu' => $this->menu(),
            ]));
        }

        $slugs = explode('/', rtrim($slug, '/'));

        $item = $this->item($slugs);
        if (!$item) {
            throw new NotFoundHttpException();
        }

        return new Response($this->twig->render($this->twigFile, [
            'item'        => $item,
            'menu'        => $this->menu(),
            'breadcrumbs' => $slugs,
        ]));
    }

    private function item(array $slugs): ?array
    {
        return Yaml::parse(@file_get_contents($this->itemsPath . '/' . implode('/', $slugs) . '.yml'));
    }

    private function menu(): array
    {
        $finder = new Finder();
        $dir = $finder->directories()->in($this->itemsPath)->depth(0);
        $items = $this->getDirectoryContent($dir, $this->prefixPath);

        return $items;
    }

    private function getDirectoryContent(Finder $dir, string $slug, array $dirItems = []): array
    {
        /** @var File $subDir */
        foreach ($dir as $subDir) {
            $finder = new Finder();
            $newDir = $finder->directories()->in($subDir->getPathname())->depth(0);

            if (count($newDir) > 0) {
                $dirItems[$subDir->getBasename()]['children'] = $this->getDirectoryContent(
                    $newDir,
                    $slug . '/' . $subDir->getBasename(),
                    $dirItems
                );
                $dirItems[$subDir->getBasename()]['title'] = $subDir->getBasename();

                continue;
            }

            /** @var File $file */
            foreach ($newDir->files() as $file) {
                $filename = pathinfo($file->getFilename(), PATHINFO_FILENAME);
                $itemConfig = Yaml::parse(file_get_contents($file->getRealPath()));

                $dirItems[$subDir->getBasename()]['title'] = $subDir->getBasename();
                $dirItems[$subDir->getBasename()]['children'][] = [
                    'title'  => $filename,
                    'slug'   => $slug . '/' . $subDir->getBasename() . '/' . $filename,
                    'status' => $itemConfig['status'],
                ];
            }
        }

        return $dirItems;
    }
}
