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
        $this->tplWorkspace = realpath($tplWorkspace);
    }

    /**
     * @param string $tplId
     * @return string
     * @throws Exception
     */
    public function loadTemplate(string $tplId) : string
    {
        $filename = $this->resolveFileName($tplId);
        return $this->getFileTag($tplId) . file_get_contents($filename) . $this->getFileTag($tplId, 'END');
    }

    private static function getFileTag($filename, $placeholder = 'BEGIN'): string
    {
        return sprintf("<!-- %s %s -->", $placeholder, $filename);
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
            '%s/partials/%s.html',
        ];

        foreach ($pathTemplates as $pathTemplate)
        {
            $path = realpath(sprintf($pathTemplate, $this->tplWorkspace, $tplId));

            if ($path && is_file($path))
            {
                return realpath($path);
            }
        }

        throw new Exception('Can not find file for template ' . $tplId);
    }
}
