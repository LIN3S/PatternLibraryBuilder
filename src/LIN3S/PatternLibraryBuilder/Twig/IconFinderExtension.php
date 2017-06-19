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

namespace LIN3S\PatternLibraryBuilder\Twig;

use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;

/**
 * @author Mikel Tuesta <mikeltuesta@gmail.com>
 * @author Beñat Espiña <benatespina@gmail.com>
 * @author Gorka Laucirica <gorka.lauzirika@gmail.com>
 */
final class IconFinderExtension extends \Twig_Extension
{
    private $iconsPath;

    public function __construct(array $config)
    {
        $this->iconsPath = $config['iconography']['path'];
    }

    public function getFunctions() : array
    {
        return [
            new \Twig_SimpleFunction('find_icons', [$this, 'findIcons']),
        ];
    }

    public function findIcons() : array
    {
        $finder = new Finder();
        $files = $finder->directories()->in($this->iconsPath)->files();

        $icons = [];
        foreach ($files as $file) {
            $icons[] = $this->iconName($file);
        }

        return $icons;
    }

    private function iconName(SplFileInfo $file) : string
    {
        $svgFileName = pathinfo($file->getFilename(), PATHINFO_FILENAME);

        return pathinfo($svgFileName, PATHINFO_FILENAME);
    }
}
