<?php
function linearSearch($arr, $x)
{
// Percorre cada elemento da lista
    for ($i = 0; $i < count($arr); $i++) {
// Verifica se o elemento atual é igual ao item procurado
        if ($arr[$i] == $x) {
// Se sim, retorna o índice do elemento
            return $i;
        }
    }
// Se o item não foi encontrado, retorna -1
    return -1;
}

// Testa a função com uma lista de números inteiros
$arr = [1, 3, 5, 7, 9];
$x = 5;
$result = linearSearch($arr, $x);
echo "O item procurado está no índice: " . $result;
