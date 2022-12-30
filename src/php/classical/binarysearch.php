<?php

function binarySearch($arr, $x) {
    // Define os limites inicial e final da lista
    $left = 0;
    $right = count($arr) - 1;

    // Enquanto houver elementos na lista para serem verificados
    while ($left <= $right) {
        // Calcula o índice do elemento do meio da lista
        $mid = floor(($left + $right) / 2);

        // Verifica se o elemento do meio é igual ao item procurado
        if ($arr[$mid] == $x) {
            // Se sim, retorna o índice do elemento
            return $mid;
        }
        // Se o item procurado é menor do que o elemento do meio,
        // descarta a metade da lista à direita do elemento do meio
        else if ($x < $arr[$mid]) {
            $right = $mid - 1;
        }
        // Se o item procurado é maior do que o elemento do meio,
        // descarta a metade da lista à esquerda do elemento do meio
        else {
            $left = $mid + 1;
        }
    }
    // Se o item não foi encontrado, retorna -1
    return -1;
}

// Testa a função com uma lista de números inteiros ordenados
$arr = [1, 3, 5, 7, 9];
$x = 5;
$result = binarySearch($arr, $x);
echo "O item procurado está no índice: " . $result;
