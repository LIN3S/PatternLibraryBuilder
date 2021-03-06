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

use Gajus\Dindent\Indenter;

/**
 * @author Beñat Espiña <benatespina@gmail.com>
 */
final class IndentHtmlCodeExtension extends \Twig_Extension
{
    private $indenter;

    public function __construct()
    {
        $this->indenter = new Indenter();
    }

    public function getFilters() : array
    {
        return [
            new \Twig_SimpleFilter('indent_html', [$this, 'indent']),
        ];
    }

    public function indent(string $html) : string
    {
        return htmlspecialchars($this->indenter->indent($html));
    }
}
