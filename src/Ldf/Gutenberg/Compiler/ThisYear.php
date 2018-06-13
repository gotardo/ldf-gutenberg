<?php

declare(strict_types=1);

namespace Ldf\Gutenberg\Compiler;

/**
 * Class ThisYear
 * @package Ldf\Gutenberg\Compiler
 */
class ThisYear implements ICompiler
{
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
