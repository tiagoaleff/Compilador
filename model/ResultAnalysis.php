<?php

/**
 * Created by PhpStorm.
 * User: tiagoaleff
 * Date: 11/04/16
 * Time: 20:25
 */
class ResultAnalysis
{
    private $token; //token
    private $note; // nome do token
    private $code; // codigo da palavra
    private $text; // string que foi analizada
    private $errorToken; // guarda o erra de uma palavra
    private $tokenError;
    private $line;

    /**
     * @return mixed
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @return mixed
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * @param mixed $note
     */
    public function setNote($note)
    {
        $this->note = $note;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param mixed $code
     */
    public function setCode($code)
    {
        $this->code = $code;
        return $this;
    }

    /**
     * @param mixed $token
     */
    public function setToken($token)
    {
        $this->token = $token;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getErrorToken()
    {
        return $this->errorToken;
    }

    /**
     * @param mixed $errorToken
     */
    public function setErrorToken($errorToken)
    {
        $this->errorToken = $errorToken;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTokenError()
    {
        return $this->tokenError;
    }

    /**
     * @param mixed $tokenError
     */
    public function setTokenError($tokenError)
    {
        $this->tokenError = $tokenError;
    }

    /**
     * @return mixed
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param mixed $text
     */
    public function setText($text)
    {
        $this->text = $text;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLine()
    {
        return $this->line;
    }

    /**
     * @param mixed $line
     */
    public function setLine($line)
    {
        $this->line = $line;
        return $this;
    }

}