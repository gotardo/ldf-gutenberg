<?php

declare(strict_types=1);

namespace Ldf\Gutenberg;

/**
 * Interface ICompiler
 * @package Ldf\Gutenberg\Compiler
 */
interface ICompiler
{
    /**
     * @param string $tpl
     * @return string
     * @throws Exception
     */
    public function compile(string $tpl) : string;
}
