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
 * @author Mikel Tuesta <mikeltuesta@gmail.com>
 */
final class IndentTwigCodeExtension extends \Twig_Extension
{
    public function getFunctions() : array
    {
        return [
            new \Twig_SimpleFunction('indent_twig_parameters', [$this, 'indent']),
        ];
    }

    public function indent($parameters) : string
    {
        return $this->prettifyParameters($parameters) . $this->newLine();
    }

    private function prettifyParameters($parameters, string $str = '', int $indentationLevel = 1) : string
    {
        if (is_array($parameters)) {
            $parameterIndex = 0;
            $parametersCount = count($parameters);

            foreach ($parameters as $key => $value) {
                if (!is_numeric($key)) {
                    $str .= $this->newLine() . $this->doIndent($indentationLevel) . $key . ': ';
                }

                if (is_array($value)) {
                    $isAssociative = $this->isAssociative($value);
                    $str .= $isAssociative ? '{' : '[';
                    $str = $this->prettifyParameters(
                        $value,
                        $str,
                        $isAssociative
                            ? $indentationLevel + 1
                            : $indentationLevel
                    );
                    $str .= $isAssociative ? $this->newLine() . $this->doIndent($indentationLevel) . '}' : ']';
                } else {
                    $str .= '\'' . $value . '\'';
                }

                ++$parameterIndex;
                if ($parameterIndex !== $parametersCount) {
                    $str .= ',';
                }
            }
        } else {
            $str .= $parameters;
        }

        return $str;
    }

    private function isAssociative(array $arr) : bool
    {
        if ([] === $arr) {
            return false;
        }

        return array_keys($arr) !== range(0, count($arr) - 1);
    }

    private function newLine() : string
    {
        return "\n";
    }

    private function doIndent(int $indentationLevel) : string
    {
        $indentationStr = '';
        $indentationIterations = 0;
        while ($indentationIterations < $indentationLevel) {
            $indentationStr .= "\t";
            ++$indentationIterations;
        }

        return $indentationStr;
    }
}
