<?php

/**
 * Created by PhpStorm.
 * User: tiagoaleff
 * Date: 22/05/16
 * Time: 18:49
 */
class ErrorModel
{

    private $line;
    private $expected;
    private $testeError;
    private $errorFile;


    public function __construct()
    {
        $this->errorFile = json_decode(file_get_contents('../file/error.json'));
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        $expected = $this->expected;

        if (!empty($this->errorFile->$expected)) {

            $expected = $this->errorFile->$expected;

        }
        if ($this->testeError)
            return "Error! Próximo a Linha: " . $this->line . '. Experava-se: ' . $expected;

        return false;
    }
    /**
     * @param mixed $line
     */
    public function setLine($line)
    {
        $this->testeError = true;
        $this->line = $line;
        return $this;
    }

    /**
     * @param mixed $expected
     */
    public function setExpected($expected)
    {
        $this->testeError = true;
        $this->expected = $expected;
        return $this;
    }

}