<?php

function bubble_sort_simples($array) {
    $n = count($array);
    for ($i = 0; $i < $n; $i++) {
        for ($j = 0; $j < $n - $i - 1; $j++) {
            if ($array[$j] > $array[$j + 1]) {
                // Troca os elementos de lugar
                $temp = $array[$j];
                $array[$j] = $array[$j + 1];
                $array[$j + 1] = $temp;
            }
        }
    }
    return $array;
}

// Exemplo de uso
$array = [3, 5, 1, 4, 2];
$array = bubble_sort_simples($array);
print_r($array); // [1, 2, 3, 4, 5]

function bubble_sort($array) {
    $n = count($array);
    $swapped = true;
    while ($swapped) {
        $swapped = false;
        for ($i = 0; $i < $n - 1; $i++) {
            if ($array[$i] > $array[$i + 1]) {
                // Troca os elementos de lugar
                $temp = $array[$i];
                $array[$i] = $array[$i + 1];
                $array[$i + 1] = $temp;
                $swapped = true;
            }
        }
    }
    return $array;
}

// Exemplo de uso
$array = [3, 5, 1, 4, 2];
$array = bubble_sort($array);
print_r($array); // [1, 2, 3, 4, 5]
