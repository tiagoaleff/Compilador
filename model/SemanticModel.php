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

        $this->findValuesToVerify($this->getNameVariable(), "Variavel redeclarada. Linha: " . $this->getLine() .
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

        $this->insertTable = $this->findValuesToVerify($semantic ->getNameVariable(), "Variavel redeclarada. Linha: " . $this->getLine() .
            " Nome da variavel: " . $semantic->getNameVariable() . " .Categoria: " . $semantic->getCategory());
        $this->setTableSemantic($semantic);
    }

    // # 120
    public function useVariableDeclared()
    {
        foreach ($this->getTableSemantic() as $value) {

            if ($value->getNameVariable() == $this->getNameVariable()){

                return true;

            }

        }

        $this->msgError [] = "Variavel não declarada. Linha: " . $this->getLine() . ' : ' . $this->getNameVariable();
    }
    // # 121
    public function labelAndProcedure()
    {

        $command = '';

        if (isset($this->stackFoundValues[count($this->stackFoundValues) - 2])) {
            $command = $this->stackFoundValues[count($this->stackFoundValues) - 2];
        }

        //echo $command; exit();

        if (!$this->getValueTableSemantic($command, $this->getNameVariable())) {
            $this->msgError [] = 'Linha:' . $this->getLine() . '. Nome: ' . $this->getNameVariable() .
                ' .Message: Variavel  não foi declarada para ser chamada!';
        }
    }

    private function getValueTableSemantic($category, $value)
    {

        foreach ($this->getTableSemantic() as $tableItem) {

            if ($tableItem->getNameVariable() == $value) {

                var_dump($category );

                if ($category == 12 && $tableItem->getCategory() == 'label') {
                    return true;
                } else if ($category == 11 && $tableItem->getCategory() == 'procedure') {
                    return true;
                }


            }

        }

        return false;
    }

    // # 121
    public function __destruct()
    {
        //echo '<pre>';
        //print_r($this->stackFoundValues);
        //exit();
    }

}