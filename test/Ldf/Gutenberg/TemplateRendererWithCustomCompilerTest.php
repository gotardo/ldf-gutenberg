<?php

declare(strict_types=1);

namespace Ldf\Gutenberg\Compiler;

use Ldf\Gutenberg\ITemplateLoader;
use Ldf\Gutenberg\TemplateRenderer;
use Mockery\MockInterface;
use PHPUnit\Framework\TestCase;
use Test\Gutenberg\Compiler\Mock;

/**
 * Class TemplateRendererWithCustomCompilerTest
 * @package Ldf\Gutenberg\Compiler
 * @coversDefaultClass \Ldf\Gutenberg\TemplateRenderer
 */
class TemplateRendererWithCustomCompilerTest extends TestCase
{
    /**
     * @var TemplateRenderer $sut
     */
    var $sut;

    public function setUp()
    {
        $templateLoaderMock = \Mockery::mock(ITemplateLoader::class);
        $templateLoaderMock
            ->shouldReceive('loadTemplate')
            ->withAnyArgs()
            ->andReturn('fake template: <strong>This is a fake template</strong>');

        $this->sut = new TemplateRenderer($templateLoaderMock);
    }

    public function tearDown()
    {
        parent::tearDown();

        if ($container = \Mockery::getContainer()) {
            $this->addToAssertionCount($container->mockery_getExpectationCount());
        }

       \Mockery::close();
    }

    /**
     * @covers ::addCustomCompiler
     */
    public function test_addCustomCompiler_SetCompilersToBeCalled_Always()
    {

        $mock1 = self::mockCompiler();
        $mock2 = self::mockCompiler();
        $this->sut
            ->addCustomCompiler($mock1)
            ->addCustomCompiler($mock2);

        $this->sut->render('tplId');

        $mock1->shouldHaveReceived('compile');
        $mock2->shouldHaveReceived('compile');
    }

    private static function mockCompiler(): MockInterface
    {
        $mock = Mock::compiler();
        $mock->shouldReceive('compile')->withAnyArgs()->andReturn('-> compiled');
        return $mock;
    }
}