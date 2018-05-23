<?php

declare(strict_types=1);

namespace Ldf\Gutenberg;

/**
 * Class FileTemplateLoader
 *
 * Loads templates from the file system.
 * @package Ldf\Gutenberg
 */
class FileTemplateLoader implements ITemplateLoader
{
    private $tplWorkspace;

    /**
     * FileTemplateLoader constructor.
     *
     * The workspace (a directory).
     *
     * @param string $tplWorkspace
     */
    public function __construct(string $tplWorkspace)
    {
        $this->tplWorkspace = $tplWorkspace;
    }

    /**
     * @param string $tplId
     * @return string
     * @throws Exception
     */
    public function loadTemplate(string $tplId) : string
    {
        $filename = $this->resolveFileName($tplId);
        return $this->getFileTag($filename) . file_get_contents($filename);
    }

    private static function getFileTag($filename): string
    {
        return sprintf("<!-- %s -->", $filename);
    }

    /**
     * @param string $tplId
     * @return string
     * @throws Exception
     */
    private function resolveFileName(string $tplId) : string
    {
        $pathTemplates = [
            '%s/%s',
            '%s/_%s',
            '%s/%s.html',
            '%s/_%s.html',
        ];

        foreach ($pathTemplates as $pathTemplate)
        {
            $path = realpath(sprintf($pathTemplate, $this->tplWorkspace, $tplId));

            if ($path && file_exists($path))
            {
                return realpath($path);
            }
        }

        throw new Exception('Can not find file for template ' . $tplId);
    }
}
