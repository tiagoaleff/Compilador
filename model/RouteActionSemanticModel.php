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
                $this->semantic->saveNameAndCategoryAndLevelAndVerify();
                break;
            case 101 :
                break;
            case 102 :
                break;

        }
    }

    public function getTableSemantic()
    {
        return $this->semantic->getTableSemantic();
    }

    public function getName()
    {
        if (isset($this->stackFoundValues[count($this->stackFoundValues)])) {
            return $this->stackFoundValues[count($this->stackFoundValues)];
        }

        return -1;
    }


}