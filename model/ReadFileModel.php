<?php

/**
 * Created by PhpStorm.
 * User: tiagoaleff
 * Date: 11/04/16
 * Time: 19:52
 */
class ReadFileModel
{
    private $content;

    public function readFile()
    {
        $this->content = file("../file/code.txt");
        return  $this->content;
    }

    public function readFileString()
    {
        $fileString = file_get_contents("../file/code.txt");
        return  $fileString;
    }
}