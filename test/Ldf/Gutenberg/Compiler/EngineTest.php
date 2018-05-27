<?php

declare(strict_types=1);

namespace Test\Gutenberg\Compiler;

use Ldf\Gutenberg\Compiler\Engine;
use Ldf\Gutenberg\Compiler\ICompiler;
use Ldf\Gutenberg\Exception;
use Mockery\MockInterface;
use PHPUnit\Framework\TestCase;

/**
 * Class EngineTest
 * @package Test\Gutenberg\Compiler
 * @coversDefaultClass \Ldf\Gutenberg\Compiler\Engine
 */
class EngineTest extends AbstractTest
{
    private const FAKE_TEMPLATE =  '<div>This is the fake template</div>';

    /**
     * @covers ::compile
     */
    public function test_Compile_Calls_EveryInjectedCompilers()
    {
        // Arrange
        $compilerMock1 = self::getWorkingICompiledMock();
        $compilerMock2 = self::getWorkingICompiledMock();

        $sut = new Engine($compilerMock1, $compilerMock2);

        // Act
        $sut->compile(self::FAKE_TEMPLATE);

        // Assert
        $compilerMock1->shouldHaveReceived('compile');
        $compilerMock2->shouldHaveReceived('compile');
    }

    /**
     * @covers ::compile
     * @expectedException Exception
     */
    public function test_Compile_ThrowsException_WhenACompilerThrowsException()
    {
        // Arrange
        $compilerMock1 = Mock::getFailingICompiledMock();
        $compilerMock2 = Mock::getFailingICompiledMock();

        // Act
        $sut = new Engine($compilerMock1, $compilerMock2);

        // Assert
        $sut->compile(self::FAKE_TEMPLATE);
    }

    private static function getWorkingICompiledMock(): MockInterface
    {
        $compilerMock = Mock::compiler();
        $compilerMock->shouldReceive('compile')
            ->withAnyArgs()
            ->andReturn('- rendered');
        return $compilerMock;
    }
}
