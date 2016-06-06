<?php

/**
 * Created by PhpStorm.
 * User: tiagoaleff
 * Date: 21/05/16
 * Time: 21:16
 */
class MatrizAnalizeSintatica
{

    private $stringMatriz;

    public function __construct()
    {
        $this->stringMatriz = file_get_contents("../file/analiseSintatica.json");
    }

    public function getMatriz($notTerminal, $terminal)
    {
        $matriz = json_decode($this->stringMatriz );

        if (!empty($matriz->$notTerminal->$terminal)){

            $ruleMatriz = $matriz->$notTerminal->$terminal;
            return $ruleMatriz;

        }

        return null;
    }

}