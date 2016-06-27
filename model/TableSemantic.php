<?php

/**
 * Created by PhpStorm.
 * User: tiagoaleff
 * Date: 6/26/16
 * Time: 7:28 PM
 */
class TableSemantic
{
    private $nameVariable; // nome da variavel
    private $category; // nome da categoria
    private $level; // valor do nivel
    private $aritmetico; // valor booleano se é aritmetico
    private $countParameters;

    public function __construct($name, $category, $level, $countParameters, $aritmetico = false)
    {
        $this->setNameVariable($name);
        $this->setCategory($category);
        $this->setLevel($level);
        $this->setCountParameters($countParameters);

        if ($aritmetico)
            $this->setAritmetico($aritmetico);
    }

    /**
     * @return mixed
     */
    public function getNameVariable()
    {
        return $this->nameVariable;
    }

    /**
     * @param mixed $nameVariable
     * @return TableSemantic
     */
    public function setNameVariable($nameVariable)
    {
        $this->nameVariable = $nameVariable;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param mixed $category
     * @return TableSemantic
     */
    public function setCategory($category)
    {
        $this->category = $category;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * @param mixed $level
     * @return TableSemantic
     */
    public function setLevel($level)
    {
        $this->level = $level;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAritmetico()
    {
        return $this->aritmetico;
    }

    /**
     * @param mixed $aritmetico
     * @return TableSemantic
     */
    public function setAritmetico($aritmetico)
    {
        $this->aritmetico = $aritmetico;
        return $this;
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
     * @return TableSemantic
     */
    public function setCountParameters($countParameters)
    {
        $this->countParameters = $countParameters;
        return $this;
    } // quantidade de parametros;

}