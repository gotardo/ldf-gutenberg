<?php

declare(strict_types=1);

namespace Ldf\Gutenberg;

/**
 * Interface IWipeOutConfigurable
 * @package Ldf\Gutenberg
 */
interface IWipeOutConfigurable
{
    /**
     * Configure template WipeOut for a Template renderer.
     * @return IRenderer
     */
    public function withWipeOut(): IRenderer;
}
