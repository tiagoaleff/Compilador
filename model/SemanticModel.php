<?php

/**
 * Created by PhpStorm.
 * User: tiagoaleff
 * Date: 6/26/16
 * Time: 9:01 PM
 */
include_once 'SemanticBaseModel.php';

class SemanticModel extends SemanticBaseModel
{

    public function __construct()
    {
        parent::__construct();
    }

    public  function saveNameAndCategoryAndLevelAndVerify()
    {

        $this->setCategory()->setLevelPlus()->setBooAritmetic(false)->setCountParameters(0);
        $semantic = new TableSemantic($this->getNameVariable(), $this->getCategory(),
            $this->getLevel(), $this->getBooAritmetic());

        $this->findValuesToVerify($this->getNameVariable(), $this->getLevel(),
            $semantic ->getCategory(), "Variavel redeclarada. Linha: " . $this->getLine() .
            " Nome da variavel: " . $semantic->getNameVariable() . " .Categoria: " . $semantic->getCategory());

        $this->setTableSemantic($semantic);

    }

    public  function saveCategoryAndLevel()
    {
        $this->setCategory()->setLevelPlus()->setBooAritmetic(false)->setCountParameters(0);
    }

    public  function saveNameAndVerify()
    {

        $semantic = new TableSemantic($this->getNameVariable(), $this->getCategory(),
            $this->getLevel(), $this->getBooAritmetic());

        $this->insertTable = $this->findValuesToVerify($semantic ->getNameVariable(), $semantic ->getLevel(),
            $semantic ->getCategory(), "Variavel redeclarada. Linha: " . $this->getLine() .
            " Nome da variavel: " . $semantic->getNameVariable() . " .Categoria: " . $semantic->getCategory());

        $this->setTableSemantic($semantic);

    }

    // # 120
    public function useVariableDeclared()
    {

        foreach ($this->getTableSemantic() as $value) {

            if ($value->getNameVariable() == $this->nameVariable
                && $value->getCategory() == $this->getCategory()) {

                echo $this->getNameVariable() . '<br>';
                echo $this->getLevel() . '<br>';
                echo $this->getCategory() . '<br>';
                echo $this->getLine() . '<br>';


                $teste = $this->findValuesToVerify($this->getNameVariable(), $this->getLevel(),
                    $this->getCategory(), "Variavel não declarada. Linha: " . $this->getLine() .
                    " Nome da variavel: " . $this->getNameVariable() . " .Categoria: " . $this->getCategory());
            }
        }


    }


    // # 121

    public function __destruct()
    {
        //echo '<pre>';
        //print_r($this->stackFoundValues);
        //exit();
    }

}