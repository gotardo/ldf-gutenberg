<?php

declare(strict_types=1);

namespace Ldf\Gutenberg\Compiler;

/**
 * Class Engine
 *
 * Composes an array of expression compilers (ICompiler) and execute them.
 * @package Ldf\Gutenberg\Compiler
 */
class Engine implements ICompiler
{
    /**
     * @var ICompiler[] $compilers
     */
    private $compilers = [];

    public function __construct(ICompiler ...$compilers)
    {
        $this->compilers = $compilers;
    }

    /**
     * @inheritdoc
     */
    public function compile(string $tpl): string
    {
        // TODO use reduce
        foreach ($this->compilers as $compiler)
        {
            $tpl = $compiler->compile($tpl);
        }

        return $tpl;
    }

}
