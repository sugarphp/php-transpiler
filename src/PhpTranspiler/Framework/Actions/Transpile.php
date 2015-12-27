<?php

namespace PhpTranspiler\Framework\Actions;

use PhpTranspiler\Framework\PhpSourceSanitization;
use PhpTranspiler\Framework\SourceDir;

class Transpile
{
    /** @var  SourceDir $outputDir */
    private $outputDir;

    /**
     * Transpile constructor.
     *
     * @param SourceDir $outputDir
     */
    public function __construct($outputDir)
    {
        $this->outputDir = $outputDir;
    }

    public function run()
    {
        $files = $this->outputDir->getFiles();
        foreach ($files as $file) {
            $file->setStringContent((new PhpSourceSanitization($file->stringContent()))->stringContent());
        }
    }
}