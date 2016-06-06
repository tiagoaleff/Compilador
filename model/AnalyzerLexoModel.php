<?php

/**
 * Created by PhpStorm.
 * User: tiagoaleff
 * Date: 11/04/16
 * Time: 20:10
 */
class AnalyzerLexoModel
{
    private $result;
    private $line;
    private $comment; // guarda os comentários
    private $literal;
    private $testeLiteral;
    private $testComment;

    public function __construct()
    {
        include 'ToStringStatic.php';
        include 'ResultAnalysis.php';
        $this->comment = '';
    }

    public function setLine($line)
    {
        $this->line = $line;
    }

    public function run($text)
    {
        foreach ($text as $key => $value) {

            $i = 0;	// conta dos caracteres
            $newWord = ''; // palavra que será analizada
            $this->setLine($key + 1);

            while($i < strlen($value)) {

                if ($this->literal($value[$i]) && $this->comment($value[$i])) {

                    if ($value[$i] !== " " && $value[$i] !== "\n")
                        $newWord .= $value[$i];

                    $after = $i;
                    $after++;

                    if ($value[$i] === " " || ($after >= strlen($value)) ||
                        $value[$i] == "\n" || $value[$i] == "\"") {
                        // chama metodo de analise de palavra
                        if (!empty($newWord)) {

                            $this->toAnalyze($newWord);
                            $newWord = '';

                        }
                    }
                }

                $i++;
            }

        }

        $this->endDocument();
        return $this->result;
    }

    public function toAnalyze($textToAnalizer)
    {

        if (ctype_alpha($textToAnalizer[0])) {

            $this->reservedWord($textToAnalizer);

        } else if (is_numeric($textToAnalizer[0])) {

            $this->numerics($textToAnalizer);

        }

        $this->simbolos($textToAnalizer);

        //echo $textToAnalizer . '<br>';

        return $this->result;
    }

    public function reservedWord($tokenToAnalizer)
    {

        $result = new ResultAnalysis();
        $token = null;
        $code = null;

        switch ($tokenToAnalizer) {

            case 'program' :
                $token = 'PROGRAM';
                $code = 1;
                break;

            case 'label' :
                $token = 'LABEL';
                $code = 2;
                break;

            case 'const' :
                $token = 'CONST';
                $code = 3;
                break;

            case 'var' :
                $token = 'VAR';
                $code = 4;
                break;

            case 'procedure' :
                $token = 'PROCEDURE';
                $code = 5;
                break;

            case 'begin' :
                $token = 'BEGIN';
                $code = 6;
                break;

            case 'end' :
                $token = 'END';
                $code = 7;
                break;

            case 'int' :
                $token = 'INT';
                $code = 8;
                break;

            case 'array' :
                $token = 'ARRAY';
                $code = 9;
                break;

            case 'of' :
                $token = 'OF';
                $code = 10;
                break;

            case 'call' :
                $token = 'CALL';
                $code = 11;
                break;

            case 'goto' :
                $token = 'GOTO';
                $code = 12;
                break;

            case 'if' :
                $token = 'IF';
                $code = 13;
                break;

            case 'then' :
                $token = 'THEN';
                $code = 14;
                break;

            case 'else' :
                $token = 'ELSE';
                $code = 15;
                break;

            case 'while' :
                $token = 'WHILE';
                $code = 16;
                break;

            case 'do' :
                $token = 'DO';
                $code = 17;
                break;

            case 'repeat' :
                $token = 'REPEAT';
                $code = 18;
                break;

            case 'until' :
                $token = 'UNTIL';
                $code = 19;
                break;

            case 'readln' :
                $token = 'READLN';
                $code = 20;
                break;

            case 'writeln' :
                $token = 'WRITELN';
                $code = 21;
                break;

            case 'or' :
                $token = 'OR';
                $code = 22;
                break;

            case 'and' :
                $token = 'AND';
                $code = 23;
                break;

            case 'not' :
                $token = 'NOT';
                $code = 24;
                break;

            case 'for' :
                $token = 'FOR';
                $code = 27;
                break;

            case 'to' :
                $token = 'TO';
                $code = 28;
                break;

            case 'case' :
                $token = 'CASE';
                $code = 29;
                break;

        }

        if (!empty($token)) {

            $result->setToken($token)->setCode($code)->setNote('Palavra-Reservada')
                ->setText($tokenToAnalizer)->setLine($this->line);
            $this->result [] = $result;
            return;

        }

        // se não for uma palavra reservada pode ser  uma variavel
        if (ctype_alnum($tokenToAnalizer)) {

            $result->setToken('IDENTIFICADOR')->setCode(25)->setNote('Identificador')
                ->setText($tokenToAnalizer)->setLine($this->line);
            $this->result [] = $result;
            return;

        }

        $newToken = '';

        for ($i = 0; $i < strlen($tokenToAnalizer); $i++) {

            if (ctype_alnum($tokenToAnalizer[$i])) {

                $newToken .= $tokenToAnalizer[$i];

            } else {

                $this->reservedWord($newToken);
                $tokenToAnalizer = str_replace($newToken, '', $tokenToAnalizer);
                $this->toAnalyze($tokenToAnalizer);
                return;

            }

        }
    }

    /*
     * Identifica token numericos
     */
    public function numerics($tokenToAnalizer)
    {
        $numeric = new ResultAnalysis();

        if (is_numeric($tokenToAnalizer[0])) {

            $newNumeric = '';

            for ($i = 0; $i < strlen($tokenToAnalizer); $i++) {

                if (is_numeric($tokenToAnalizer[$i])) {

                    $newNumeric .= $tokenToAnalizer[$i];

                } else {

                    $numeric->setCode(26)
                        ->setToken('INTEGER')
                        ->setLine($this->line)
                        ->setText($newNumeric)
                        ->setNote('Numero Inteiro');

                    $this->result [] = $numeric;

                    $tokenToAnalizer = substr($tokenToAnalizer, strlen($newNumeric));
                    return $this->toAnalyze($tokenToAnalizer);

                }

            }

            $numeric->setCode(26)
                ->setToken('INTEGER')
                ->setLine($this->line)
                ->setText($newNumeric)
                ->setNote('Numero Inteiro');

            $this->result [] = $numeric;

        }

    }

    public function simpleToken($textToAnalizer)
    {
        $simpleToken = [

            '+' => 30,
            '-' => 31,
            '*' => 32,
            '/' => 33,
            '[' => 34,
            ']' => 35,
            '(' => 36,
            ')' => 37,
            ',' => 46,
            ';' => 47,
            '>' => 41,
            '<' => 43,
            ':' => 39,
            '='=> 40,
            '.' => 49
        ];

        // verifica se o indice existe, se exitir entao obtem o token dele
        if (isset($simpleToken[$textToAnalizer[0]])) {

            $token = new ResultAnalysis();
            $token->setToken($textToAnalizer[0])
                ->setCode($simpleToken[$textToAnalizer[0]])
                ->setNote('Símbolo simples')
                ->setLine($this->line)
                ->setText($textToAnalizer[0]);

            $this->result [] = $token;
            $textToAnalizer = substr($textToAnalizer, 1);
            $this->simpleToken($textToAnalizer);
            return;

        }

        $this->toAnalyze($textToAnalizer);
    }

    private function testSimpleToken($textoToAnalizer)
    {
        //$simpleToken = [ '+', '-', '*', '/', '[', ']', '(', ')', ',', ';', '.', '..', '>', '<', ':', '='];
        $simpleToken = [ '+', '-', '*', '/', '[', ']', '(', ')', ',', ';', '>', '<', ':', '=', '.'];

        if (in_array($textoToAnalizer[0], $simpleToken)) {

            $this->simpleToken($textoToAnalizer);

        }
    }

    private function simbolos($textoToAnalizer)
    {

        if ($textoToAnalizer[0] === ':' && isset($textoToAnalizer[1]) && $textoToAnalizer[1] === '=' ||
            $textoToAnalizer[0] === '>' && isset($textoToAnalizer[1]) && $textoToAnalizer[1] === '=' ||
            $textoToAnalizer[0] === '<' && isset($textoToAnalizer[1]) && $textoToAnalizer[1] === '=' ||
            $textoToAnalizer[0] === '<' && isset($textoToAnalizer[1]) && $textoToAnalizer[1] === '>' ||
            $textoToAnalizer[0] === '.' && isset($textoToAnalizer[1]) && $textoToAnalizer[1] === '.' ||
            $textoToAnalizer[0] === '.' && isset($textoToAnalizer[1]) && $textoToAnalizer[1] === '.') {

            $this->double($textoToAnalizer, ':', '=', 38);
            $this->double($textoToAnalizer, '>', '=', 42);
            $this->double($textoToAnalizer, '<', '=', 44);
            $this->double($textoToAnalizer, '<', '>', 45);
            $this->double($textoToAnalizer, '.', '.', 50);

        } else  {

            $this->testSimpleToken($textoToAnalizer);

        }
    }

    public function literal($caracter)
    {
        $result = new ResultAnalysis();

        if ($caracter == "\"") {

            $this->testeLiteral = ($this->testeLiteral == true ? false : true);

        }

        if ($this->testeLiteral && $caracter != "\"") {

            $this->literal .= $caracter;
            return false;

        } else if (! $this->testeLiteral&& !empty($this->literal)) {

            $result->setToken('Literal')->setCode(48)->setLine($this->line)->setText($this->literal);
            $this->result[] = $result;
            $this->literal = '';
            return false;

        }

        return true;
    }

    public function comment($caracter)
    {

        return true;
    }

    private function double($text, $first, $second, $code)
    {

        if ($text[0] === $first && $text[1] === $second) {

            $token = new ResultAnalysis();
            $token->setToken($first . $second)->setCode($code)->setNote('Simbolo Duplo')
                ->setLine($this->line)->setText($text[0] . $text[1]);
            $this->result [] = $token;
            $text = substr($text, 2);
            $this->toAnalyze($text);
        }

    }

    private function endDocument()
    {
        $token = new ResultAnalysis();

        if (!empty($this->result)) {
            $token->setToken('$')->setCode(51)->setNote('Fim de Arquivo')
                ->setLine($this->line);
            $this->result [] = $token;
        } else {
            $token->setToken('')->setCode(52)->setNote('VAZIO')
                ->setLine('');
            $this->result [] = $token;
        }

    }
}

