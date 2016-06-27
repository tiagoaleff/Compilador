<?php

/**
 * Created by PhpStorm.
 * User: tiagoaleff
 * Date: 6/26/16
 * Time: 9:01 PM
 */
class SemanticModel
{
    private $category;
    private $level;
    private $tableSemantic;

    public function __construct()
    {
        include_once "TableSemantic.php";

        $this->tableSemantic = new TableSemantic();
    }

}