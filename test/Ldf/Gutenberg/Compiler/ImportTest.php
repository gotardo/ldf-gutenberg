<?php

declare(strict_types=1);

namespace Test\Gutenberg\Compiler;

use Ldf\Gutenberg\Compiler\Import;
use Ldf\Gutenberg\Exception;
use Mockery\MockInterface;

/**
 * Class ImportTest
 * @package Test\Gutenberg\Compiler
 * @coversDefaultClass \Ldf\Gutenberg\Compiler\Import
 */
class ImportTest extends AbstractTest
{
    /**
     * @var MockInterface for IRenderer
     */
    private $renderer;

    /**
     * @var Import Import Compiler (System Under Test).
     */
    private $sut;


    /**
     * @inheritdoc
     */
    public function setUp()
    {
        $this->renderer = Mock::renderer();
        $this->sut = new Import($this->renderer);
    }

    /**
     * @covers ::compile
     */
    public function test_Compile_ReturnsImportedTemplate_WithValidTemplateId()
    {
        // Arrange
        $template = "<div>{{ import _animals }} \n {{ import _fruits }}</div>";
        $animalsTemplate = "<div>dog cat duck</div>";
        $fruitsTemplate = "<div>apple pineapple</div>";

        $this->renderer
            ->shouldReceive('render')
            ->with('_animals')
            ->andReturn($animalsTemplate);

        $this->renderer
            ->shouldReceive('render')
            ->with('_fruits')
            ->andReturn($fruitsTemplate);

        // Act
        $result = $this->sut->compile($template);

        // Assert
        $this->assertContains($animalsTemplate, $result);
        $this->assertContains($fruitsTemplate, $result);
        $this->renderer->shouldHaveReceived('render');
    }

    /**
     * @covers ::compile
     * @expectedException Exception
     */
    public function test_Compile_ThrowsException_WithInvalidTemplateId()
    {
        // Arrange
        $template = "<div>{{ import _animals }} \n {{ import _fruits }}</div>";

        // Act
        $this->renderer
            ->shouldReceive('render')
            ->with('_animals')
            ->andThrow(Exception::class);

        // Assert
        $this->sut->compile($template);
    }
}
