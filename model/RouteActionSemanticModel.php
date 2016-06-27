<?php

/**
 * Created by PhpStorm.
 * User: tiagoaleff
 * Date: 6/26/16
 * Time: 9:47 PM
 */
class RouteActionSemanticModel
{
    private $stackFoundValues; // onde o analisador semantico irá procurar os valores
    private $semantic;
    private $stackSemantic;

    public function __construct()
    {
        include_once 'SemanticModel.php';

        $this->semantic = new SemanticModel();
    }

    /**
     * @param mixed $stackFoundValues
     */
    public function setStackFoundValues($stackFoundValues)
    {
        $this->semantic->setStackFoundValues($stackFoundValues);
    }


    public function routeSemantic($action)
    {
        switch ($action) {

            case 100 :
                $this->stackSemantic [] = $this->semantic->saveNameAndCategoryAndLevelAndVerify();
                break;
            case 101 :
                $this->stackSemantic [] = $this->semantic->saveCategoryAndLevel();
                break;
            case 102 :
                $this->stackSemantic [] = $this->semantic->saveNameAndVerify();
                break;

            case 120:
                //$this->semantic->useVariableDeclared();
                break;
            case 121:
                //$this->semantic->setLessLevel();
                break;
            case 123 :
                //$this->semantic->setLevelLocal();
                break;
        }
    }

    /*
     * Retoorna o resultado, ou seja, a tabela semantica
     */
    public function getTableSemantic()
    {
        return $this->semantic->getTableSemantic();
    }


    public function setNameVariable($name)
    {
        $this->semantic->setNameVariable($name);
    }

    public function getMessageError()
    {
        return $this->semantic->getMessageErrorSemantic();
    }

    public function setLine($line)
    {
        $this->semantic->setLine($line);
    }

    public function getInsertTable()
    {
        return $this->semantic->getInsertTable();
    }
}