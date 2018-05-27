<?php

declare(strict_types=1);

namespace Test\Gutenberg\Compiler;

use PHPUnit\Framework\TestCase;

/**
 * Class AbstractTest
 *
 * @package Test\Gutenberg\Compiler
 */
abstract class AbstractTest extends TestCase
{
    use \Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;

    /**
     * @inheritdoc
     */
    public function tearDown()
    {
        \Mockery::close();
    }
}
