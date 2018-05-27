<?php

declare(strict_types=1);

namespace Test\Gutenberg\Compiler;

use Ldf\Gutenberg\Compiler\XWing;
use PHPUnit\Framework\TestCase;

/**
 * Class XWingTest
 * @package Test\Gutenberg\Compiler
 * @coversDefaultClass \Ldf\Gutenberg\Compiler\XWing
 */
class XWingTest extends TestCase
{

    /**
     * @covers ::compile
     */
    public function test_Compile_RemovesAllComments_Always()
    {
        $sut = new XWing();
        $tpl =
<<<EOT
{{-
{{- Comment
{{-
<div>
    This is actual content {{- This should not be displayed        
</div>
EOT;
        $result = $sut->compile($tpl);

        $this->assertNotContains('{{-', $result);
        $this->assertNotContains('This should not be displayed', $result);
        $this->assertContains('actual content', $result);
    }
}
