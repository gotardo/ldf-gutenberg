<?php

declare(strict_types=1);

namespace Test\Ldf\Gutenberg;

use Ldf\Gutenberg\Gutenberg;
use PHPUnit\Framework\TestCase;

/**
 * Class FileTemplateLoaderTest
 * @package Test\Ldf\Gutenberg
 * @coversDefaultClass \Ldf\Gutenberg\Gutenberg
 */
class GutenbergTest extends TestCase
{

    public function test()
    {
        $result = Gutenberg::ForWorkspace('fake');
        $this->assertEquals(get_class($result), Gutenberg::class);
    }
}
