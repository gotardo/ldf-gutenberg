<?php

declare(strict_types=1);

namespace Test\Gutenberg\Compiler;

use Ldf\Gutenberg\ICompiler;
use Ldf\Gutenberg\Exception;
use Ldf\Gutenberg\IRenderer;
use Mockery\MockInterface;

/**
 * Class Mock
 * @package Test\Gutenberg\Compiler
 */
class Mock
{
    /**
     * Returns a yet not configured Mock for ICompiler.
     *
     * @return MockInterface for ICompiler.
     */
    public static function compiler(): MockInterface
    {
        return \Mockery::mock(ICompiler::class);
    }

    /**
     * Returns a yet not configured Mock for IRenderer.
     *
     * @return MockInterface for IRenderer
     */
    public static function renderer(): MockInterface
    {
        return \Mockery::mock(IRenderer::class);
    }

    /**
     * Returns a Mock for ICompiler that will fail with a Ldf\Gutenberg\Exception when called with any arguments.
     *
     * @return MockInterface
     */
    public static function getFailingICompiledMock(): MockInterface
    {
        $compilerMock = self::compiler();
        $compilerMock->shouldReceive('compile')
            ->withAnyArgs()
            ->andThrow(Exception::class);
        return $compilerMock;
    }
}
