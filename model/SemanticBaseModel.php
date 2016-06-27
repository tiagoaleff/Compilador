<?php

/**
 * Created by PhpStorm.
 * User: tiagoaleff
 * Date: 6/27/16
 * Time: 3:40 AM
 */
include_once "SemanticAbstract.php";

abstract class SemanticBaseModel
{
    protected $category; // guarda o valor da categoria
    private $level; // guarda o valor do nivel
    protected $nameVariable; // nome da variavel inserida na tabela
    private $tableSemantic;  // guarda os valores atuais para a tabela semantica
    protected $msgError; // guarda um array com todos os erros encontrados
    protected $stackFoundValues;
    private $booAritmetic;
    private $countParameters;
    private $line;
    protected $insertTable;


    public function __construct()
    {
        include_once "TableSemantic.php";

        $this->tableSemantic = [];
        $this->msgError = [];
           $this->stackFoundValues = [];
        $this->level = 0;
        $this->setBooAritmetic(false);
        $this->setCountParameters(0);

    }

    /**
     * @return mixed
     */
    public function getLine()
    {
        return $this->line;
    }

    /**
     * @param mixed $line
     * @return SemanticBaseModel
     */
    public function setLine($line)
    {
        $this->line = $line;
        return $this;
    }

    /**
     * @param array $msgError
     */
    public function setMsgError($msgError)
    {
        $this->msgError = $msgError;
    }

    /**
     * @return mixed
     */
    public function getCountParameters()
    {
        return $this->countParameters;
    }

    /**
     * @param mixed $countParameters
     */
    public function setCountParameters($countParameters)
    {
        $this->countParameters = $countParameters;
        return $this;
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

    /**
     * @param mixed $category
     * @return SemanticModel
     */
    public function setCategory()
    {
        $category = $this->stackFoundValues[count($this->stackFoundValues) - 1] ;

        if ($category == 1 || $category == 2 || $category == 3 ||
            $category == 4 || $category == 5) {

            $this->category = $this->stackFoundValues[count($this->stackFoundValues) - 1];

        } else if (isset($this->stackFoundValues[count($this->stackFoundValues) - 2])) {
            $this->category = $this->stackFoundValues[count($this->stackFoundValues) - 2];
        }
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
        print_r($testeVariavel);
        echo '</pre>';

        if ($teste) exit();
    }

    /**
     * @return mixed
     */
    public function getCategory()
    {

        $category = [
            1 => 'program',
            2 => 'label',
            3 => 'const',
            4 => 'var',
            5 => 'procedure'
        ];

        if (isset($category[$this->category])) {
            $categoryName = $category[$this->category];
        } else {
            $categoryName = "Erro: " . $this->category;
        }


        return $categoryName ;
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

    public function setLevelPlus($value)
    {
        $this->level  += $value;
        return $this;
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
        return $this;
    }

    protected function findValuesToVerify($name, $level, $category, $message)
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

    /*
     * Responsavel por guardar o nome escrito e não em codigo do
     */
    public function setNameVariable($name)
    {
        $this->nameVariable = $name;
        return $this;
    }

    public function getInsertTable()
    {
        return $this->insertTable;
    }

}