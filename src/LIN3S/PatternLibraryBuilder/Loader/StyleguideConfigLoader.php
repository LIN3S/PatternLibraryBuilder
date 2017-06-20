<?php

/*
 * This file is part of the Pattern Library Builder library.
 *
 * Copyright (c) 2017-present LIN3S <info@lin3s.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace LIN3S\PatternLibraryBuilder\Loader;

use Symfony\Component\Finder\Finder;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Yaml\Yaml;

class StyleguideConfigLoader
{
    private $config;
    private $itemsPath;
    private $prefixPath;

    public function __construct(string $itemsPath, string $prefixPath = '/design-system')
    {
        $this->itemsPath = $itemsPath;
        $this->prefixPath = $prefixPath;
        $this->config = $this->loadConfig();
    }

    public function allInHierarchy() : array
    {
        return $this->config;
    }

    public function allInPlain() : array
    {
        return $this->findAllItemsRecursively($this->config);
    }

    public function get(string $slug) : array
    {
        return $this->findBySlugRecursively($slug, $this->config)['config'];
    }

    private function findBySlugRecursively(string $slug, array $config) : ?array
    {
        foreach ($config as $child) {
            if (isset($child['slug'])) {
                if ($child['slug'] === $this->prefixPath . '/' . $slug) {
                    return $child;
                }
            }

            if (isset($child['children'])) {
                $children = $this->findBySlugRecursively($slug, $child['children']);
                if ($children) {
                    return $children;
                }
            }
        }

        return null;
    }

    private function findAllItemsRecursively(array $config, array $items = []) : array
    {
        foreach ($config as $child) {
            if (isset($child['config'])) {
                $items[] = $child;
            }

            if (isset($child['children'])) {
                $items = array_merge($items, $this->findAllItemsRecursively($child['children'], $items));
            }
        }

        return $items;
    }

    private function loadConfig() : array
    {
        $finder = new Finder();
        $dir = $finder->directories()->in($this->itemsPath)->depth(0);
        $items = $this->getDirectoryContent($dir, $this->prefixPath);

        return $items;
    }

    private function getDirectoryContent(Finder $dir, string $slug, array $dirItems = []) : array
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
                    'config' => $itemConfig,
                    'status' => $itemConfig['status'],
                ];
            }
        }

        return $dirItems;
    }
}
