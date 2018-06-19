<?php

declare(strict_types=1);

namespace Ldf\Gutenberg;

/**
 * Class BuildRenderer
 *
 * Builds a renderer.
 *
 * @package Ldf\Gutenberg
 */
class Gutenberg implements IWipeOutConfigurable
{
    private $renderer;

    private function __construct(IRenderer $renderer)
    {
        $this->renderer = $renderer;
    }

    /**
     * Begin the creation of a renderer for a determinate workspace.
     *
     * @param string $workspacePath The identifier of the workspace.
     * @return IWipeOutConfigurable
     */
    public static function ForWorkspace(string $workspacePath) : Gutenberg
    {
        return new self(new TemplateRenderer(new FileTemplateLoader($workspacePath)));
    }

    /**
     * @return IRenderer
     */
    public function withWipeOut() : Gutenberg
    {
        $this->renderer = new TemplateWipeOut($this->renderer);
        return $this;
    }

    public function get(): IRenderer
    {
        return $this->renderer;
    }
}
