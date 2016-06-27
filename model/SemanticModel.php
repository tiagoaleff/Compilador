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

        $this->setCategory()->setLevelPlus(0)->setBooAritmetic(false)->setCountParameters(0);
        $semantic = new TableSemantic($this->getNameVariable(), $this->getCategory(),
            $this->getLevel(), $this->getBooAritmetic());

        $inserir = $this->findValuesToVerify($this->getNameVariable(), $this->getLevel(),
            $this->getCategory(), "Variavel redeclarada");

        if ($inserir) {
            $this->setTableSemantic($semantic);
        }

        echo '<pre>';
        print_r($this->stackFoundValues);
    }

    public  function saveCategoryAndLevel()
    {
        $this->setCategory()->setLevelPlus(0)->setBooAritmetic(false)->setCountParameters(0);
        print_r($this->stackFoundValues);
    }

    public  function saveNameAndVerify()
    {

        if ($this->getCategory() != null && $this->getLevel() != null) {
            $this->msgError [] = "Configuraçao para esta variavel nao 'ste!";
            return false;
        }

        $semantic = new TableSemantic($this->getNameVariable(), $this->getCategory(),
          $this->getLevel(), $this->getBooAritmetic());

        $this->setTableSemantic($semantic);

        echo '<pre>';
        //print_r($this->stackFoundValues);
        exit();
    }

}