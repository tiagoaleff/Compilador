<?php

/**
 * Created by PhpStorm.
 * User: tiagoaleff
 * Date: 22/05/16
 * Time: 12:11
 */
class CompiladorController
{

    private $analyzerLexo;
    private $analyzerSystactic;

    public function __construct()
    {
        include_once 'AnalyzerLexoController.php';
        include_once '../controller/AnalyzerSyntacticController.php';
        $this->analyzerLexo = new AnalyzerLexoController();
        $this->analyzerSystactic = new AnalyzerSyntacticController();
    }

    public function getResultLexo()
    {
        $this->analyzerLexo = $this->analyzerLexo->getResult();
        return $this->analyzerLexo;
    }

    public function getResultSystactic()
    {
        return $this->analyzerSystactic->getResultAnalyzer($this->analyzerLexo);
    }

    public function getErrorMessage()
    {
        return $this->analyzerSystactic->getErrorMessage();
    }

    public function getSemantic()
    {
        return $this->analyzerSystactic->getSemantic();
    }

    public function getErroSemantico()
    {
        return $this->analyzerSystactic->getErroSemantico();
    }

}