<?php

declare(strict_types=1);

namespace Ldf\Gutenberg\Compiler;

use Ldf\Gutenberg\ICompiler;
use Ldf\Gutenberg\IRenderer;

/**
 * Class Import
 *
 * Implements the {{ import [template/id] }} expression.
 *
 * @package Ldf\Gutenberg\Compiler
 */
class Import implements ICompiler
{
    private $renderer;

    /**
     * Import constructor.
     * @param IRenderer $renderer
     */
    public function __construct(IRenderer $renderer)
    {
        $this->renderer = $renderer;
    }

    /**
     * @param string $tpl
     * @return string
     * @throws \Ldf\Gutenberg\Exception
     */
    public function compile(string $tpl): string
    {
        preg_match_all('/{{ import (_.*) }}/', $tpl, $matches);

        // TODO use reduce
        foreach($matches[0] as $key =>  $expression)
        {
            $tpl = str_replace($expression, $this->renderer->render($matches[1][$key]), $tpl);
        }

        return $tpl;
    }
}
