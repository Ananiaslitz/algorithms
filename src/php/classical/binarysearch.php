<?php
class BinarySearch {
    // Realiza a busca binária em um array ordenado
    public function search($arr, $x) {
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
}

// Cria um objeto da classe BinarySearch
$bs = new BinarySearch();

// Realiza a busca por um elemento existente no array
$arr = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
$x = 5;
$result = $bs->search($arr, $x);
echo "Resultado da busca por $x: $result\n";

// Realiza a busca por um elemento que não existe no array
$x = 11;
$result = $bs->search($arr, $x);
echo "Resultado da busca por $x: $result\n";
