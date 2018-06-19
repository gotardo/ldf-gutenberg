<?php

declare(strict_types=1);

namespace Ldf\Gutenberg\Compiler;

use Ldf\Gutenberg\ICompiler;

/**
 * Class XWing
 *
 * Implements the comments or XWing expression {{-
 *
 * @package Ldf\Gutenberg\Compiler
 */
class XWing implements ICompiler
{
    /**
     * @inheritdoc
     */
    public function compile(string $tpl) : string
    {
        return preg_replace('/{{-(.*)/', '', $tpl);
    }
}
