<?php

declare(strict_types=1);

namespace Ldf\Gutenberg;

/**
 * Interface ITemplateLoader
 * @package Ldf\Gutenberg
 */
interface ITemplateLoader
{
    /**
     * Loads a template with a given identifier.
     *
     * @param string $tplId The template identifier.
     * @return string
     */
    public function loadTemplate(string $tplId) : string;
}
