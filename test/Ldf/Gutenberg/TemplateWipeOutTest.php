<?php

declare(strict_types=1);

namespace Test\Gutenberg;

use Ldf\Gutenberg\TemplateWipeOut;
use PHPUnit\Framework\TestCase;
use Test\Gutenberg\Compiler\Mock;

/**
 * Class TemplateWipeOutTest
 * @package Test\Gutenberg
 * @coversDefaultClass \Ldf\Gutenberg\TemplateWipeOut
 */
class TemplateWipeOutTest extends TestCase
{
    /**
     * @covers ::__construct
     * @covers ::render()
     * @expectedException \PHPUnit\Framework\Error\Warning
     */
    public function test_Render_ShouldCleanTags_WhenUnparsedTagsAreFound()
    {
        $template = "This is the template {{ unfound-tag }}";
        $renderer = Mock::renderer();
        $renderer
            ->shouldReceive('render')
            ->withArgs([$template, []])
            ->andReturn($template);
        $sut = new TemplateWipeOut($renderer);

        $result = $sut->render($template, []);

        $this->assertEquals('This is the template', $result);
    }

    /**
     * @covers ::__construct
     * @covers ::render()
     */
    public function test_Render_ShouldDoNothing_WhenNoUnparsedTagsAreFound()
    {
        $template = "This is the template";
        $renderer = Mock::renderer();
        $renderer
            ->shouldReceive('render')
            ->withArgs([$template, []])
            ->andReturn($template);
        $sut = new TemplateWipeOut($renderer);

        $result = $sut->render($template, []);

        $this->assertEquals($template, $result);
    }
}
