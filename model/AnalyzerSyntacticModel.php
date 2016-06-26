<?php

/**
 * Created by PhpStorm.
 * User: tiagoaleff
 * Date: 22/05/16
 * Time: 12:53
 */
class AnalyzerSyntacticModel
{
    private $matriz;
    private $producaoCodificacao;
    private $resultLexo;
    private $stackOfArray; // guarda o estado da pilha em um array;
    private $stack; // guarda a pilha atual
    private $messageError;

    public function __construct()
    {
        include_once 'MatrizAnalizeSintatica.php';
        include_once 'ProducaoCodificacaoModel.php';
        include_once 'ResultSyntactic.php';
        include_once 'ErrorModel.php';
        $this->matriz = new MatrizAnalizeSintatica();
        $this->producaoCodificacao = new ProducaoCodificacaoModel();
        $this->messageError = new ErrorModel();

        $this->stackOfArray = [];
        $this->stack = [];

        // inicializa a pilha com 51 no fim da pilha e 53 no inicio da pilha
        array_push($this->stack, 51);
        array_push($this->stack, 53);

        $this->setStackOfArray($this->stack, 'Inicial');

    }

    /*
     * Função responsavel por verificar erros no codigo fonte
     */
    public function parser()
    {
        $valueA = null;
        $valueX = null;

        $valueX = $this->getX($this->stack); // retorna o ultimo elemento da pilha
        $valueA = $this->getA(); // retorna o simbolo de entrada

        do {
            // testa se x é vazio
            if ($valueX == 52) {

                //echo 'x é vazio';
                array_pop($this->stack);
                $this->setStackOfArray($this->stack, "Exclusão");
                $valueX = $this->getX($this->stack);
                continue;

            } else if ($valueX > 0 && $valueX < 51) { // testa se o valor de x é terminal

                if ($valueX == $valueA) {

                    array_pop($this->stack);
                    $this->setStackOfArray($this->stack, "Exclusão");
                    array_shift($this->resultLexo);
                    $this->parser();

                    return false;
                } else {

                    $this->messageError->setLine($this->resultLexo[0]->getLine())
                        ->setExpected($valueX);
                    return;

                }

            } else {

                if ($valueX != 51) {

                    // inserir if else aqui. Verificando se é maior que 88, entao realiza a acao semantica

                    if ($this->matriz->getMatriz($valueX, $valueA)) { // testa se exeste na matriz

                        array_pop($this->stack);
                        $this->setStackOfArray($this->stack, 'Exclusão'); // guarda registro da pilha
                        //pilha ganha regra
                        $this->stack = $this->producaoCodificacao->getRulesMatriz($this->stack, $this->matriz->getMatriz($valueX, $valueA));
                        $valueX = $this->getX($this->stack);
                        $this->setStackOfArray($this->stack, 'Inserção'); // guarda registro da pilha

                    } else {

                        $this->messageError->setLine($this->resultLexo[0]->getLine())
                            ->setExpected($valueX);
                        return;

                    }
                }

            }


        } while($valueX != 51);

    }

    public function setResultLexo($lexo)
    {
        $this->resultLexo = $lexo;
    }

    private function getA()
    {
        if (!empty($this->resultLexo[0]->getCode())){

            return $this->resultLexo[0]->getCode();

        } else {

            return null;
        }
    }

    private function getX(array $stack)
    {
        $lenght = count($stack);

        $lenght--;

        if(!empty($stack[$lenght])) {
            return $stack[$lenght];
        }

        return null;
    }

    private function setStackOfArray($stack, $status )
    {
        $result = new ResultSyntactic();
        $result->setArrayStack($stack)->setStatus($status);
        $this->stackOfArray[] = $result;
    }

    public function getStackOfArray()
    {
        return $this->stackOfArray;
    }

    public function getMessageError()
    {
        return $this->messageError->getMessage();
    }


}