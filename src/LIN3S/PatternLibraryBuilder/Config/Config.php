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

/**
 * @author Gorka Laucirica <gorka.lauzirika@gmail.com>
 */
final class Config
{
    private $config;

    public function __construct(array $config)
    {
        $this->config = $config;
    }

    public function allInHierarchy(): array
    {
        return $this->config;
    }

    public function allInPlain(): array
    {
        return $this->findAllItemsRecursively($this->config);
    }

    public function get(string $slug): ?array
    {
        return $this->findBySlugRecursively($slug, $this->config)['config'];
    }

    private function findBySlugRecursively(string $slug, array $config): ?array
    {
        if ($config['index'] && $config['index']['slug'] === $slug) {
            return $config['index'];
        }

        foreach ($config['pages'] as $page) {
            if ($page['slug'] === $slug) {
                return $page;
            }
        }

        foreach ($config['children'] as $child) {
            $children = $this->findBySlugRecursively($slug, $child);
            if ($children) {
                return $children;
            }
        }

        return null;
    }

    private function findAllItemsRecursively(array $config, array $items = []): array
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
}
