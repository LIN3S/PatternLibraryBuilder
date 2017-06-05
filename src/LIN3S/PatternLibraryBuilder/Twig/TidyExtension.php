<?php

declare(strict_types=1);

/*
 * This file is part of the Pattern Library Builder project.
 *
 * Copyright (c) 2017-present LIN3S <info@lin3s.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LIN3S\PatternLibraryBuilder\Twig;

/**
 * @author Beñat Espiña <benatespina@gmail.com>
 */
class TidyExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return [
            new \Twig_SimpleFilter('tidy', [$this, 'tidy']),
        ];
    }

    public function tidy($html)
    {
        $config = [
            'indent'              => true,
            'indent-spaces'       => 4,
            'output-html'         => true,
            'output-xml'          => true,
            'output-xhtml'        => true,
            'wrap'                => false,
            'show-body-only'      => true,
        ];

        $tidy = tidy_parse_string($html, $config, 'UTF8');
        $tidy->cleanRepair();

        return $tidy->value;
    }
}
