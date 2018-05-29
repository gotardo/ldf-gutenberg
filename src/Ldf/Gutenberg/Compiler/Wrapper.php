<?php

declare(strict_types=1);

namespace Ldf\Gutenberg\Compiler;

use Ldf\Gutenberg\Exception;
use Ldf\Gutenberg\IRenderer;

/**
 * Class Wrapper
 *
 * Implements the {{ wrapper [template/id] }} expression.
 *
 * @package Ldf\Gutenberg\Compiler
 */
class Wrapper implements ICompiler
{
    private $renderer;

    public function __construct(IRenderer $renderer)
    {
        $this->renderer = $renderer;
    }

    /**
     * @inheritdoc
     */
    public function compile(string $tpl) : string
    {
        $baseTpl = self::getBaseTemplate($tpl);
        if ($baseTpl)
        {
            return self::cleanseInheritanceTag($baseTpl, $this->renderer->render($baseTpl, ['content' => $tpl]));
        }
        return $tpl;
    }

    private static function cleanseInheritanceTag(string $baseTpl, string $tpl): string
    {
        return str_replace('{{ wrapper ' . $baseTpl . ' }}', '',  $tpl);
    }

    private static function getBaseTemplate(string $tpl) : ?string
    {
        preg_match('/{{ wrapper (_.*) }}/', $tpl, $matches);

        if (count($matches) > 2)
        {
            throw new Exception('Too many `wrapper` expressions in template');
        }

        if (array_key_exists(1, $matches))
        {
            return $matches[1];
        }

        return null;
    }
}