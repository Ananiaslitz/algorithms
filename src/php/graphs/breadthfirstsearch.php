<?php

// Função que adiciona um vértice ao final da fila
function enqueue(&$queue, $vertex) {
    array_push($queue, $vertex);
}

// Função que remove e retorna o primeiro vértice da fila
function dequeue(&$queue) {
    return array_shift($queue);
}

// Função que realiza a busca em largura a partir de um vértice inicial
function breadthFirstSearch($graph, $start) {
    // Cria uma fila vazia e adiciona o vértice inicial
    $queue = [];
    enqueue($queue, $start);

    // Cria um vetor de visitação para marcar os vértices já visitados
    $visited = [];
    for ($i = 0; $i < count($graph); $i++) {
        $visited[$i] = false;
    }

    // Marca o vértice inicial como visitado
    $visited[$start] = true;

    // Enquanto a fila não estiver vazia
    while (count($queue) != 0) {
        // Remove o primeiro vértice da fila e imprime seu valor
        $vertex = dequeue($queue);
        echo $vertex . " ";

        // Adiciona todos os vértices adjacentes não visitados à fila
        foreach ($graph[$vertex] as $neighbor) {
            if (!$visited[$neighbor]) {
                enqueue($queue, $neighbor);
                $visited[$neighbor] = true;
            }
        }
    }
}

// Cria o grafo representado como uma matriz de adjacência
$graph = [
    [1, 2, 3],  // vértice 0 tem arestas para os vértices 1, 2 e 3
    [0, 4, 5],  // vértice 1 tem arestas para os vértices 0, 4 e 5
    [0, 6],     // vértice 2 tem arestas para os vértices 0 e 6
    [0],        // vértice 3 tem uma aresta para o vértice 0
    [1],        // vértice 4 tem uma aresta para o vértice 1
    [1],        // vértice 5 tem uma aresta para o vértice 1
    [2]         // vértice 6 tem uma aresta para o vértice 2
];

// Realiza a busca a partir do vértice 0
breadthFirstSearch($graph, 0);
