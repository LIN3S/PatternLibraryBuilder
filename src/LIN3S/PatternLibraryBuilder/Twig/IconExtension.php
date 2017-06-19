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

/**
 * @author Gorka Laucirica <gorka@lin3s.com>
 */
final class IconExtension extends \Twig_Extension
{
    private $twig;
    private $twigNamespace;

    public function __construct(\Twig_Environment $twig, array $config)
    {
        $this->twig = $twig;
        $this->twigNamespace = $config['iconography']['twig_namespace'];
    }

    public function getFunctions() : array
    {
        return [
            new \Twig_SimpleFunction('icon', [$this, 'renderIcon'], ['is_safe' => ['html']]),
        ];
    }

    public function renderIcon(string $icon = '', array $modifiers = []) : ?string
    {
        try {
            return $this->twig->render(
                sprintf('%s/%s.svg.twig', $this->twigNamespace, $icon),
                [
                    'modifiers' => $modifiers,
                ]
            );
        } catch (\Twig_Error_Loader $e) {
            // Catch error when icon not found
            return null;
        }
    }
}
