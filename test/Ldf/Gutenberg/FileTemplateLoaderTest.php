<?php

declare(strict_types=1);

namespace Test\Ldf\Gutenberg;

use Ldf\Gutenberg\FileTemplateLoader;
use PHPUnit\Framework\TestCase;

/**
 * Class FileTemplateLoaderTest
 * @package Test\Ldf\Gutenberg
 * @coversDefaultClass \Ldf\Gutenberg\FileTemplateLoader
 */
class FileTemplateLoaderTest extends TestCase
{
    /**
     * @var FileTemplateLoader $sut
     */
    private $sut;

    /**
     * @inheritdoc
     */
    public function setUp()
    {
        $this->sut = new FileTemplateLoader(__DIR__ . "/FakeTemplates");
    }

    /**
     * Provides a list of valid ids.
     * @return array
     */
    public function validTemplateIdProvider(): array
    {
        return [
            ['myTemplate'],
            ['myTemplate.html'],
            ['partial/_widget'],
            ['partial/header'],
        ];
    }

    /**
     * @param string $tplId
     * @covers ::loadTemplate()
     * @covers ::__construct
     * @covers ::resolveFileName()
     * @dataProvider validTemplateIdProvider
     * @throws
     */
    public function test_LoadTemplate_ReturnsTemplate_WithValidId(string $tplId): void
    {
        $result = $this->sut->loadTemplate($tplId);
        $this->assertContains('{{ ok }}', $result);
    }

    /**
     * @param string $tplId
     * @covers ::getFileTag()
     * @dataProvider validTemplateIdProvider
     * @throws
     */
    public function test_LoadTemplate_AddsFileTag_OnTemplateLoaded(string $tplId): void
    {
        $result = $this->sut->loadTemplate($tplId);
        $this->assertContains('<!--', $result);
        $this->assertContains($tplId, $result);
        $this->assertContains('-->', $result);
    }


    /**
     * @covers ::resolveFileName()
     * @expectedException \Ldf\Gutenberg\Exception
     */
    public function test_resolveFileName_ThrowsException_WithInvalidId(): void
    {
        $this->sut->loadTemplate('FakeId');
    }

}
