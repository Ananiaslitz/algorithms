<?php

function quick_sort($array) {
    // Verifica se o tamanho do array é menor ou igual a 1
    if (count($array) <= 1) {
        return $array;
    }

    // Seleciona o elemento central como pivot
    $pivot = $array[0];
    $left = $right = array();

    // Particiona os elementos do array em duas partes
    // Esquerda: menores que o pivot
    // Direita: maiores que o pivot
    for ($i = 1; $i < count($array); $i++) {
        if ($array[$i] < $pivot) {
            $left[] = $array[$i];
        } else {
            $right[] = $array[$i];
        }
    }

    // Chama a função recursivamente para as duas partes
    return array_merge(quick_sort($left), array($pivot), quick_sort($right));
}

// Exemplo de uso
$array = array(5, 2, 9, 1, 3, 6, 4, 7, 8);
$sorted_array = quick_sort($array);

print_r($sorted_array);
// Saída: Array ( [0] => 1 [1] => 2 [2] => 3 [3] => 4 [4] => 5 [5] => 6 [6] => 7 [7] => 8 [8] => 9 )
