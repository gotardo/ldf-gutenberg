<?php

declare(strict_types=1);

namespace Ldf\Gutenberg;
use Ldf\Gutenberg\Compiler\Engine;
use Ldf\Gutenberg\Compiler\Import;
use Ldf\Gutenberg\Compiler\Wrapper;
use Ldf\Gutenberg\Compiler\XWing;

/**
 * Class TemplateRenderer
 * @package Ldf\Gutenberg
 */
class TemplateRenderer implements IRenderer
{
    /**
     * @var ITemplateLoader
     */
    private $templateLoader;

    /**
     * @var Engine
     */
    private $compiler;

    public function __construct(ITemplateLoader $templateLoader)
    {
        $this->templateLoader = $templateLoader;
        $this->compiler = new Engine(
            new XWing(),
            new Import($this),
            new Wrapper($this)
        );
    }

    /**
     * @inheritdoc
     */
    public function render(string $tplId, array $replacementMap = []) : string
    {
        return $this->resolveVariables($this->getFullTemplate($tplId), $replacementMap);
    }

    /**
     * @param string $tplId
     * @return string
     * @throws Exception
     */
    private function getFullTemplate(string $tplId): string
    {
        return $this->compiler->compile(
            $this->templateLoader->loadTemplate($tplId)
        );
    }

    private function resolveVariables(string $tpl, array $replacementMap)
    {
        $rendered = $tpl;

        foreach ($replacementMap as $replacementKey => $replacementValue)
        {
            $rendered = str_replace('{{ ' . $replacementKey .' }}', $replacementValue, $rendered);
        }

        return $rendered;
    }
}
