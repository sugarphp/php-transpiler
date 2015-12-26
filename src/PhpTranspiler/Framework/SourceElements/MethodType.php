<?php
namespace PhpTranspiler\Framework\SourceElements;

class MethodType extends MethodAnalysis
{
    public function type()
    {
        $res = PHP_T_NO_SPECIFIC_METHOD;
        if ($this->isRedundantGetter()) {
            $res = PHP_T_GETTER_METHOD;
        }

        return $res;
    }

    /**
     * @return bool
     */
    private function isRedundantGetter()
    {
        $return = $this->getReturnContent();

        return $return[0][0] === T_VARIABLE && $return[0][1] === '$this'
               && $return[1][0] === T_OBJECT_OPERATOR
               && $return[2][0] === T_STRING
               && ! isset($return[3]);
    }

    private function getReturnContent()
    {
        $return     = null;
        $tokenArray = $this->method->toTokenArray();
        foreach ($tokenArray as $i => $token) {
            if ($token[0] === T_RETURN) {
                $return = array_slice($tokenArray, $i + 2,
                    array_search(';', array_slice($tokenArray, $i + 2)));
            }
        }

        return $return;
    }
}