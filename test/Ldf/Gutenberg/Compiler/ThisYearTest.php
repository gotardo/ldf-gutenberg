<?php

declare(strict_types=1);

namespace Test\Gutenberg\Compiler;

use Ldf\Gutenberg\Compiler\ThisYear;
use Mockery\MockInterface;
use PHPUnit\Framework\TestCase;

/**
 * Class ThisYearTest
 * @package Test\Gutenberg\Compiler
 */
class ThisYearTest extends TestCase
{
    /**
     * @var \Ldf\Gutenberg\Compiler\ThisYear
     */
    private $sut;

    /**
     * @inheritdoc
     */
    public function setUp()
    {
        $this->renderer = Mock::renderer();
        $this->sut = new ThisYear();
    }

    /**
     * @throws \Ldf\Gutenberg\Exception
     */
    public function test_Compile_TransformsTagIntoYear_Always()
    {
        $result = $this->sut->compile('&copy; Copyright {{ this-year }} My Awesome Company');
        $this->assertContains(date("Y"), $result);
        $this->assertNotContains('{{ this-year }}', $result);
    }
}
