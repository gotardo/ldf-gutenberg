<?php

declare(strict_types=1);

namespace Ldf\Gutenberg\Compiler;

use Ldf\Gutenberg\IRenderer;

/**
 * Class ThisYear
 * @package Ldf\Gutenberg\Compiler
 */
class ThisYear implements ICompiler
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
        return preg_replace('/{{ this-year }}/', date('Y'), $tpl);
    }
}
