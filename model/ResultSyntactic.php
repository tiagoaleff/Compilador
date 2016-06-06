<?php

/**
 * Created by PhpStorm.
 * User: tiagoaleff
 * Date: 22/05/16
 * Time: 18:25
 */
class ResultSyntactic
{
    private $arrayStack;// guarda os indeces da pilha
    private $status;    // se é inserção ou exclusão da pilha
    private $lineError; // linha que ocorreu o erro
    private $expected;  // o que experava no lugar o erro

    /**
     * @return mixed
     */
    public function getArrayStack()
    {
        return implode(' - ', $this->arrayStack);
    }

    /**
     * @param mixed $arrayStack
     */
    public function setArrayStack($arrayStack)
    {
        $this->arrayStack = $arrayStack;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLineError()
    {
        return $this->lineError;
    }

    /**
     * @param mixed $lineError
     */
    public function setLineError($lineError)
    {
        $this->lineError = $lineError;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getExpected()
    {
        return $this->expected;
    }

    /**
     * @param mixed $expected
     */
    public function setExpected($expected)
    {
        $this->expected = $expected;
        return $this;
    }


}