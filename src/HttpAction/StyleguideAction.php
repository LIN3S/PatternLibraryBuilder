<?php

/*
 * This file is part of the Euskaltel-R project.
 *
 * Copyright (c) 2017 LIN3S <info@lin3s.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Infrastructure\Symfony\HttpAction;

use Symfony\Component\Finder\Finder;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Yaml\Yaml;

class StyleguideAction
{
    private $twig;

    public function __construct(\Twig_Environment $twig)
    {
        $this->twig = $twig;
    }

    public function __invoke(Request $request): Response
    {
        $item = $this->getItemConfig(
            $request->get('first'),
            $request->get('second'),
            $request->get('third')
        );

        if (null === $item) {
            return new Response('Item not found', 404);
        }

        $template = sprintf('@Euskaltel/pages/styleguide/%s.html.twig',
            isset($item['template']) ? $item['template'] : 'architecture'
        );

        return new Response($this->twig->render($template, [
            'item'       => $item,
            'menu'       => $this->generateMenu(),
            'breadcrumbs' => $this->generateBreadcrumb(
                $request->get('first'),
                $request->get('second'),
                $request->get('third')
            ),
        ]));
    }

    private function getItemConfig(string $first, string $second = null, string $third = null)
    {
        $file = $this->getItemConfigContents($first, $second, $third);

        if (!$file) {
            return null;
        }

        return Yaml::parse($file);
    }

    private function generateMenu(): array
    {
        $finder = new Finder();
        $dirs = $finder->directories()->in(__DIR__ . '/../../Ui/Styleguide')->depth(0);

        $items = $this->getDirContent($dirs, [], '/styleguide');

        return $items;
    }

    private function generateBreadcrumb(string $first, string $second = null, string $third = null): array
    {
        $breadcrumbs[] = $first;

        if($second) {
            $breadcrumbs[] = $second;
        }

        if($third) {
            $breadcrumbs[] = $third;
        }

        return $breadcrumbs;
    }

    private function getDirContent($dirs, $dirItems = [], $slug = ''): array
    {
        foreach ($dirs as $subDir) {
            $finder = new Finder();
            $dirs = $finder->directories()->in($subDir->getPathname())->depth(0);

            if (count($dirs) > 0) {
                $dirItems[$subDir->getBasename()]['children'] = $this->getDirContent($dirs, $dirItems, $slug . '/' . $subDir->getBasename());
                $dirItems[$subDir->getBasename()]['title'] = $subDir->getBasename();
            } else {
                /** @var File $file */
                foreach ($dirs->files() as $file) {
                    $filename = pathinfo($file->getFilename(), PATHINFO_FILENAME);

                    $fileContent = file_get_contents($file->getRealPath());
                    $itemConfig = Yaml::parse($fileContent);

                    $dirItems[$subDir->getBasename()]['title'] = $subDir->getBasename();
                    $dirItems[$subDir->getBasename()]['children'][] = [
                        'title' => $filename,
                        'slug' => $slug . '/' . $subDir->getBasename() . '/' . $filename,
                        'status' => $itemConfig['status'],
                    ];
                }
            }
        }

        return $dirItems;
    }

    private function getItemConfigContents(string $first, string $second = null, string $third = null): string
    {
        if($third) {
            return file_get_contents(sprintf(__DIR__ . '/../../Ui/Styleguide/%s/%s/%s.yml', $first, $second, $third));
        }

        if($second) {
            return file_get_contents(sprintf(__DIR__ . '/../../Ui/Styleguide/%s/%s.yml', $first, $second));
        }

        return file_get_contents(sprintf(__DIR__ . '/../../Ui/Styleguide/%s.yml', $first));
    }
}
