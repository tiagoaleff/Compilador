<?php

/**
 * Created by PhpStorm.
 * User: tiagoaleff
 * Date: 11/04/16
 * Time: 20:28
 */
class ToStringStatic
{

    public static function toString($value, $kill = true)
    {
        echo '<pre>';
        print_r($value);

        if ($kill)
            exit();

    }

    public static function toStringResult($result, $kill = true)
    {
        echo 'Token: \'' . $result->getToken() . '\' Codigo: \'' . $result->getCode() . '\' Observação: \'' . $result->getNote() . '\'<br>';

        if ($kill)
            exit();
    }

}