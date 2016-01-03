<?php
use PhpParser\PrettyPrinter\Standard;
use PhpTranspiler\Framework\PhpSourceSanitization;
use PhpTranspiler\Framework\SourceFactory;
use PhpParser\PrettyPrinter;
use PhpTranspiler\Framework\SourceFile;

class PhpTranspilerTestCase extends \PHPUnit_Framework_TestCase
{
    use SourceFactory;

    /**
     * @param string $name
     *
     * @return string
     */
    protected function emptyClassString($name)
    {
        return (new Standard)->prettyPrint(array((new PhpParser\Node\Stmt\Class_($name))));
    }

    /**
     * @param string $source
     *
     * @return null|\PhpParser\Node[]
     */
    protected function sourceToNodes($source)
    {

        return (new PhpSourceSanitization($this->sourceFactory()->parser(),
            $source))->asNodes();
    }

    /**
     * @param string $source
     *
     * @return string
     */
    protected function sanitizeSource($source)
    {

        return (new PhpSourceSanitization($this->sourceFactory()->parser(),
            $source))->stringContent();
    }

    /**
     * @param string $source
     *
     * @return SourceFile|PHPUnit_Framework_MockObject_MockObject
     */
    protected function mockSourceFile($source = '')
    {
        $sourceFile = $this->getMockBuilder('PhpTranspiler\Framework\SourceFile')->disableOriginalConstructor()->getMock();
        $sourceFile->method('stringContent')->willReturn($source);
        if ($source) {
            $sourceFile->method('sourceTree')->willReturn($this->sourceFactory()->parser()->parse($source));
        }

        return $sourceFile;
    }
}