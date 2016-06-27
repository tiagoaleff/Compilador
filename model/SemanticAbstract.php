<?php

/**
 * Created by PhpStorm.
 * User: tiagoaleff
 * Date: 6/26/16
 * Time: 7:25 PM
 */
abstract class SemanticAbstract
{
    // #100 -> tbm verifica se ja esta na tabela
    abstract public function saveNameAndCategoryAndLevelAndVerify();
    // #101
    abstract public  function saveCategoryAndLevel($category, $level);
    // #102 -> processo final, tbm verifica se ja existe na tabela
    abstract public  function saveNameAndVerify($nameVariable);

    // ...

}