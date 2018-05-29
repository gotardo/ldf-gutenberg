<?php

declare(strict_types=1);

namespace Ldf\Gutenberg;

/**
 * Interface IRenderer
 * @package Ldf\Gutenberg
 */
interface IRenderer
{
    /**
     * @param string $tplId
     * @param array $replacementMap
     * @return string
     * @throws Exception
     */
    public function render(string $tplId, array $replacementMap = []) : string;
}
