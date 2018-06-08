<?php

declare(strict_types=1);

namespace Ldf\Gutenberg;

/**
 * Class TemplateWipeOut
 *
 * Decorates an IRenderer object and cleans any tag that has not been parsed.
 *
 * @package Ldf\Gutenberg
 */
class TemplateWipeOut implements IRenderer
{
    private $decoratee;

    /**
     * TemplateWipeOut constructor.
     * @param IRenderer $decoratee
     */
    public function __construct(IRenderer $decoratee)
    {
        $this->decoratee = $decoratee;
    }

    /**
     * @inheritdoc
     */
    public function render(string $tplId, array $replacementMap = []): string
    {
        $rendered = $this->decoratee->render($tplId, $replacementMap);

        preg_match_all('/{{ (.*) }}/', $rendered, $matches);

        foreach ($matches[0] as $key => $match)
        {
            if (!in_array($matches[1][$key], ['wrapped', 'import']))
            {
                trigger_error('Use of undefined value ' . $match, E_USER_WARNING);
            }
        }

        return preg_replace('/{{ (.*) }}/', '', $rendered);
    }
}
