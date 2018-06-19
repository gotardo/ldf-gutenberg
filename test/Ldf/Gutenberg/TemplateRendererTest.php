<?php

declare(strict_types=1);

namespace Test\Gutenberg;

use Ldf\Gutenberg\Compiler\ICompiler;
use Ldf\Gutenberg\ITemplateLoader;
use Ldf\Gutenberg\TemplateRenderer;
use PHPUnit\Framework\TestCase;

/**
 * Class TemplateRendererTest
 * @package Test\Gutenberg
 * @coversDefaultClass \Ldf\Gutenberg\TemplateRenderer
 */
class TemplateRendererTest extends TestCase
{
    /**
     * @covers ::__construct
     * @covers ::render
     * @covers ::resolveVariables
     */
    public function test()
    {
        $sut = new TemplateRenderer(self::GetTemplateLoaderMock());

        $result = $sut->render('page', ['var1' => 'value1']);

        $this->assertContains("value1", $result);
        $this->assertContains("{{ unknownVar }}", $result);
    }

    private static function GetTemplateLoaderMock(): ITemplateLoader
    {
        $templateLoaderMock = \Mockery::mock(ITemplateLoader::class);
        $templateLoaderMock
            ->shouldReceive('loadTemplate')
            ->with('page')
            ->andReturn(file_get_contents(__DIR__ . '/FakeTemplates/mixed-template.html'));

        return $templateLoaderMock;
    }
}
