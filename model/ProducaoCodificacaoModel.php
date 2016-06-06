<?php

/**
 * Created by PhpStorm.
 * User: tiagoaleff
 * Date: 22/05/16
 * Time: 11:47
 */
class ProducaoCodificacaoModel
{

    private $codificacao;

    /*
     * Obtem o arquivo com as produções e transforma em uma string e depois em um objeto
     */
    public function __construct()
    {
        $this->codificacao = json_decode(file_get_contents("../file/producoesCodificacao.json"));
    }

    /*
     * $params:
     * $valueStack -> a pilha contendo as regras
     * $rule -> regra que informa quais os tokens que serao inserido na pilha
     * Função responsavel por inserir na pilha todas os tokens referente a regra especificada
     */
    public function getRulesMatriz(array $valueStack, $rule)
    {
        $arrayRules = [];

        if (!empty($this->codificacao->$rule))
            $arrayRules = $this->codificacao->$rule;
        else
            return false; // nunca deve retornar falso

        $lenghtStack = count($arrayRules);
        $lenghtStack--;

        for ($i = $lenghtStack; $i >= 0; --$i) {

            array_push($valueStack, $arrayRules[$i]);

        }

        return $valueStack;
    }

}