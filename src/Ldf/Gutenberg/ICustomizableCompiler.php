<?php

declare(strict_types=1);

namespace Ldf\Gutenberg;

/**
 * Interface ICompilerCustomizable
 *
 * @package Ldf\Gutenberg\Compiler
 */
interface ICustomizableCompiler
{
    /**
     * Adds a compiler to the compilers stack that will be called on a compile action.
     *
     * @param ICompiler $compiler
     * @return ICustomizableCompiler
     */
    public function addCustomCompiler(ICompiler $compiler): ICustomizableCompiler;
}
