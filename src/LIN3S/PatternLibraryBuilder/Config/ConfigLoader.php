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

namespace LIN3S\PatternLibraryBuilder\Config;

use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;
use Symfony\Component\Yaml\Yaml;

/**
 * @author Gorka Laucirica <gorka.lauzirika@gmail.com>
 */
final class ConfigLoader
{
    const INDEX_YML = 'index.yml';

    private $itemsPath;

    public function __construct(string $itemsPath)
    {
        $this->itemsPath = realpath($itemsPath);
    }

    public function loadConfig(): Config
    {
        $items = $this->getDirectoryContent($this->itemsPath);

        return new Config($items);
    }

    private function getDirectoryContent($path): array
    {
        $finder = new Finder();
        $childDirs = $finder->directories()->in($path)->depth(0);

        $childConfig = [];

        /** @var SplFileInfo $childDir */
        foreach ($childDirs as $childDir)
        {
            $childConfig[] = $this->getDirectoryContent($childDir->getPathname());
        }

        return [
            'title' => $this->titleFromPath($path),
            'slug' => $this->slugFromPath($path),
            'index' => $this->indexForDirectory($path),
            'children' => $childConfig,
            'pages' => $this->pagesInDirectory($path)
        ];
    }

    private function titleFromPath(string $path): string
    {
        $fileInfo = pathinfo($path);

        return $fileInfo['filename'];
    }

    private function slugFromPath(string $path): string
    {
        $slug = str_replace($this->itemsPath, '', $path);
        $slug = str_replace('index.yml', '', $slug);
        $slug = ltrim($slug, '/');
        $slug = rtrim($slug, '/');
        return str_replace('.yml', '', $slug);
    }

    private function indexForDirectory(string $path)
    {
        $indexFilePath = $path . '/' . self::INDEX_YML;
        $indexFile = @file_get_contents($indexFilePath);

        if(!$indexFile) {
            return null;
        }

        $itemConfig = Yaml::parse($indexFile);

        return $this->serializeItemConfig($itemConfig, $indexFilePath);

    }

    private function pagesInDirectory(string $path): array
    {
        $finder = new Finder();
        $pages = $finder->files()->in($path)->depth(0)->notName(self::INDEX_YML);

        $pagesConfig = [];

        foreach ($pages as $page) {
            $itemConfig = Yaml::parse(file_get_contents($page->getRealPath()));

            $pagesConfig[] = $this->serializeItemConfig($itemConfig, $page->getRealPath());
        }

        return $pagesConfig;
    }

    private function serializeItemConfig(array $itemConfig, string $configFilePath): array
    {
        return [
            'title' => $this->titleFromPath($configFilePath),
            'slug' => $this->slugFromPath($configFilePath),
            'config' => $itemConfig,
            'status' => $itemConfig['status'],
        ];
    }
}
