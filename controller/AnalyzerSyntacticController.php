<?php

/**
 * Created by PhpStorm.
 * User: tiagoaleff
 * Date: 22/05/16
 * Time: 15:12
 */
class AnalyzerSyntacticController
{

    private $syntactic;

    public function __construct()
    {
        include_once '../model/AnalyzerSyntacticModel.php';
        $this->syntactic = new AnalyzerSyntacticModel();

    }

    public function getResultAnalyzer($lexo)
    {
        $this->syntactic->setResultLexo($lexo);
        $this->syntactic->parser();
        return $this->syntactic->getStackOfArray();
    }

    public function getErrorMessage()
    {
        return $this->syntactic->getMessageError();
    }

    public function getSemantic()
    {
        return $this->syntactic->getSemanticRoute();
    }

    public function getErroSemantico()
    {
        return $this->syntactic->getErrorSemantic();
    }


}