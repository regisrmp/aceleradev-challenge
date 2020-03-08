<?php

class DesafioCriptografia
{

    public function __construct()
    {
        $this->letras = array();

        // usado a tabela ascii como base
        // a letra "a" minusculo corresponde a 97 ... a letra "z" minusculo corresponde a 122
        // dessa maneira, crio um vetor associado do numero do caracter a sua letra

        for ($i = 97; $i <= 122; $i++) {
            $this->letras[$i] = chr($i);
        }

    }


    function transformarLetra($letra, $posicoes)
    {
        // verificar se está entre "a" e "z"
        if (ord($letra) >= 97 && ord($letra) <= 122) {
            if ((ord($letra) - $posicoes) < 97) {
                // se a diferenca das casas for inferior a 97 (letra "a"), volto para a letra "z"
                $nova_posicao = 122 + ((ord($letra) - $posicoes) - 96);
            } else {
                // senão removo a posicoes de caracteres
                $nova_posicao = ord($letra) - $posicoes;
            }

            // retorno a posicao calculada acima
            return $this->letras[$nova_posicao];
        }
        else {
            // se não estiver, devolve a mesma letra
            return $letra;
        }
    }

    public function descriptografa($texto, $posicoes)
    {
        $resultado = "";

        for ($i = 0; $i < strlen($texto); $i++) {
            $resultado .= self::transformarLetra($texto[$i], $posicoes);
        }

        return $resultado;
    }
}
