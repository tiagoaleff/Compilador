<?php

/**
 * Created by PhpStorm.
 * User: tiagoaleff
 * Date: 23/05/16
 * Time: 02:16
 */
class OpenFileController
{

    public function getFileString()
    {
        $fileString = file_get_contents('../file/code.txt');
        return ltrim($fileString);
    }

}