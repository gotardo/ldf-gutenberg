<?php

declare(strict_types=1);

namespace Ldf\Gutenberg\Compiler;

/**
 * Interface ICompiler
 * @package Ldf\Gutenberg\Compiler
 */
interface ICompiler
{
    /**
     * @param string $tpl
     * @return string
     * @throws Exce
     */
    public function compile(string $tpl) : string;
}
