<?php

declare(strict_types=1);

namespace Test\Gutenberg\Compiler;

use Ldf\Gutenberg\Compiler\Wrapper;
use Ldf\Gutenberg\Exception;
use Mockery\MockInterface;
use PHPUnit\Framework\TestCase;

/**
 * Class WrapperTest
 * @package Test\Gutenberg\Compiler
 * @coversDefaultClass \Ldf\Gutenberg\Compiler\Wrapper
 */
class WrapperTest extends TestCase
{
    /**
     * @var \Ldf\Gutenberg\Compiler\Wrapper
     */
    private $sut;

    /**
     * @var MockInterface for IRenderer
     */
    private $renderer;

    /**
     * @inheritdoc
     */
    public function setUp()
    {
        $this->renderer = Mock::renderer();
        $this->renderer->shouldReceive('render')
            ->with(['_myFirstWrapper'])
            ->andReturn('<header>The header is in the wrapper</head>');

        $this->sut = new Wrapper($this->renderer);
    }

    /**
     * @covers ::compile
     * @covers ::getBaseTemplate
     */
    public function test_Compile_BypassWrapper_WhenNoWrapperIsDefined()
    {
        // Arrange
        $originalTpl = 'Nothing here';
        $this->renderer->shouldReceive('render')
            ->withAnyArgs()
            ->andReturn('<header>The header is in the wrapper</head>');

        // Act
        $resultTpl = $this->sut->compile($originalTpl);

        // Assert
        $this->assertEquals($originalTpl, $resultTpl);
    }

    /**
     * @covers ::cleanseInheritanceTag
     */
    public function test_InheritanceTag_IsCleaned_OnSuccess()
    {
        // Arrange
        $this->renderer->shouldReceive('render')
            ->withAnyArgs()
            ->andReturn('<header>The header is in the wrapper</head>');

        // Act
        $result = $this->sut->compile("{{ wrapper _myFirstWrapper }}");

        // Assert
        $this->assertNotContains('{{ wrapper', $result);
    }

    /**
     * @covers ::compile
     * @covers ::__construct
     * @covers ::getBaseTemplate
     */
    public function test_Compile_ReturnsWrappedTemplate_WithValidTagging()
    {
        // Arrange
        $wrappedTemplate =
            <<<EOT
{{ wrapper _myFirstWrapper }}
<div>
    This is the content of my template.        
</div>
EOT;
        $processedTemplate =
            <<<EOT
{{ wrapper _myFirstWrapper }}
<header>The header is in the wrapper</head>'
<div>
    This is the content of my template.        
</div>
EOT;

        $this->renderer->shouldReceive('render')
            ->withAnyArgs()
            ->andReturn($processedTemplate);

        // Act
        $result = $this->sut->compile($wrappedTemplate);

        // Assert
        $this->assertContains('<header>', $result);
        $this->assertContains('This is the content of my template.', $result);

    }
}
