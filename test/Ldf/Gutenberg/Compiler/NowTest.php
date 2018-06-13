<?php

declare(strict_types=1);

namespace Test\Gutenberg\Compiler;

use Ldf\Gutenberg\Compiler\Now;
use PHPUnit\Framework\TestCase;

/**
 * Class NowTest
 * @package Test\Gutenberg\Compiler
 */
class NowTest extends TestCase
{
    /**
     * @var \Ldf\Gutenberg\Compiler\Now
     */
    private $sut;

    /**
     * @inheritdoc
     */
    public function setUp()
    {
        $this->sut = new Now();
    }

    /**
     * @throws \Ldf\Gutenberg\Exception
     */
    public function test_Compile_TransformsTagIntoNowDate_WithMultipleTags()
    {
        $result = $this->sut->compile('{{ now Y }} {{ now d }}.');
        $this->assertContains(date('Y'), $result);
        $this->assertContains(date('d'), $result);
        $this->assertNotContains('{{ now ', $result);
    }

    /**
     * @throws \Ldf\Gutenberg\Exception
     */
    public function test_Compile_TransformsTagIntoNowDate_Always()
    {
        $result = $this->sut->compile('Compiled on {{ now Y-m-d H:i:s }}.');
        $this->assertContains(date('Y'), $result);
        $this->assertContains(date('m'), $result);
        $this->assertContains(date('d'), $result);
        $this->assertNotContains('{{ now ', $result);
    }
}
