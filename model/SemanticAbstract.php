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
    abstract protected function saveNameAndCategoryAndLevelAndVerify($nameVariable, $category, $level);
    // #101
    abstract protected function saveCategoryAndLevel($category, $level);
    // #102 -> processo final, tbm verifica se ja existe na tabela
    abstract protected function sabeNameAndVerify($nameVariable);

    // ...

}