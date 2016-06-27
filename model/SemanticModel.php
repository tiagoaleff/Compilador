<?php

/**
 * Created by PhpStorm.
 * User: tiagoaleff
 * Date: 6/26/16
 * Time: 9:01 PM
 */
include_once "SemanticAbstract.php";

class SemanticModel extends SemanticAbstract
{
    private $category; // guarda o valor da categoria
    private $level; // guarda o valor do nivel
    private $tableSemantic;  // guarda os valores atuais para a tabela semantica
    private $msgError; // guarda um array com todos os erros encontrados
    private $stackFoundValues;

    public function __construct()
    {
        include_once "TableSemantic.php";

        $this->tableSemantic = [];
        $this->msgError = [];
        $this->stackFoundValues = [];


    }

    protected function saveNameAndCategoryAndLevelAndVerify($nameVariable, $category, $level)
    {

    }

    protected function saveCategoryAndLevel($category, $level)
    {

    }

    protected function saveNameAndVerify($nameVariable)
    {

    }

    public function getTableSemantic()
    {
        return $this->tableSemantic;
    }

    // array que irá retornar as msg de erros
    public function getMessageErrorSemantic()
    {
        return $this->msgError;
    }

    public function setStackFoundValues (Array $stackFoundValues )
    {
        $this->stackFoundValues = $stackFoundValues;
    }
}