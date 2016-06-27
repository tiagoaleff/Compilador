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
    private $nameVariable; // nome da variavel inserida na tabela
    private $tableSemantic;  // guarda os valores atuais para a tabela semantica
    private $msgError; // guarda um array com todos os erros encontrados
    private $stackFoundValues;
    private $booAritmetic;

    public function __construct()
    {
        include_once "TableSemantic.php";

        $this->tableSemantic = [];
        $this->msgError = [];
        $this->stackFoundValues = [];
        $this->level = 0;
        $this->setBooAritmetic(false);

    }

    public  function saveNameAndCategoryAndLevelAndVerify()
    {
        $this->setNameVariable()->setCategory();
        $semantic = new TableSemantic($this->getNameVariable(), $this->getCategory(),
            $this->getLevel(), $this->getBooAritmetic());

        $inserir = $this->findValuesToVerify($this->getNameVariable(), $this->getLevel(),
            $this->getCategory(), "Variavel redeclarada");

        if ($inserir) {
            $this->setTableSemantic($semantic);
        }

        $this->imprimir($this->getTableSemantic());
    }

    public  function saveCategoryAndLevel($category, $level)
    {

    }

    public  function saveNameAndVerify($nameVariable)
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

    public function setStackFoundValues ($stackFoundValues )
    {
        $this->stackFoundValues [] = $stackFoundValues;
    }

    private function setNameVariable()
    {

        if (isset($this->stackFoundValues[count($this->stackFoundValues) - 1 ])) {
            $this->nameVariable = $this->stackFoundValues[count($this->stackFoundValues) - 1];
        }


        return $this;
    }

    /**
     * @param mixed $category
     * @return SemanticModel
     */
    public function setCategory()
    {
        if (isset($this->stackFoundValues[count($this->stackFoundValues) - 2]))
        $this->category = $this->stackFoundValues[count($this->stackFoundValues) - 2];
        return $this;
    }


    /**
     * Guarda em um array todos os valores da tabel
     */
    public function setTableSemantic($tableSemantic)
    {
        $this->tableSemantic [] = $tableSemantic;
        return $this;
    }



    public function imprimir($testeVariavel , $teste = false)
    {
        echo '<pre>';
            var_dump($testeVariavel);
        echo '</pre>';

        if ($teste) exit();
    }

    /**
     * @return mixed
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @return mixed
     */
    public function getNameVariable()
    {
        return $this->nameVariable;
    }

    /**
     * @return mixed
     */
    public function getLevel()
    {
        return $this->level;
    }

    public function setLevelPlus()
    {
        $this->level++;
    }

    /**
     * @return mixed
     */
    public function getBooAritmetic()
    {
        return $this->booAritmetic;
    }

    /**
     * @param mixed $booAritmetic
     */
    public function setBooAritmetic($booAritmetic)
    {
        $this->booAritmetic = $booAritmetic;
    }

    private function findValuesToVerify($name, $level, $category, $message)
    {
        foreach ($this->tableSemantic as $valueTable) {

            if ($valueTable->getNameVariable() == $name && $valueTable->getCategory() == $category
                && $valueTable->getLevel() >= $level) {
                $this->msgError [] = $message;

                return false;
            }

        }

        return true;

    }
}