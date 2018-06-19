<?php

declare(strict_types=1);

namespace Ldf\Gutenberg\Compiler;

use Ldf\Gutenberg\ICompiler;

/**
 * Class Now
 *
 * Implements the {{ now format }} expression.
 *
 * @package Ldf\Gutenberg\Compiler
 */
class Now implements ICompiler
{
    /**
     * @inheritdoc
     */
    public function compile(string $tpl): string
    {
        preg_match_all('/{{ now (.*) }}/', $tpl, $matches);

        // TODO use reduce
        foreach($matches[0] as $key =>  $expression)
        {
            $tpl = str_replace($expression, date($matches[1][$key]), $tpl);
        }

        return $tpl;
    }
}
