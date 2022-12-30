<?php

class Graph {
    private $numVertices;
    private $adjList;

    // Construtor que inicializa o número de vértices e cria a lista de adjacência
    public function __construct($numVertices) {
        $this->numVertices = $numVertices;
        $this->adjList = new SplDoublyLinkedList();
        for ($i = 0; $i < $numVertices; $i++) {
            $this->adjList->add(new SplDoublyLinkedList());
        }
    }

    // Adiciona uma aresta entre dois vértices
    public function addEdge($src, $dest) {
        $this->adjList[$src]->push($dest);
    }

    // Realiza a busca em profundidade a partir de um vértice inicial
    public function depthFirstSearch($vertex, &$visited) {
        // Marca o vértice atual como visitado e o imprime
        $visited[$vertex] = true;
        echo $vertex . " ";

        // Percorre todos os vértices adjacentes
        foreach ($this->adjList[$vertex] as $neighbor) {
            // Se o vértice adjacente ainda não foi visitado, realiza a busca nele
            if (!$visited[$neighbor]) {
                $this->depthFirstSearch($neighbor, $visited);
            }
        }
    }
}

// Cria um grafo com 7 vértices
$graph = new Graph(7);

// Adiciona as arestas
$graph->addEdge(0, 1);
$graph->addEdge(0, 2);
$graph->addEdge(1, 3);
$graph->addEdge(1, 4);
$graph->addEdge(2, 5);
$graph->addEdge(2, 6);

// Cria o vetor de visitação
$visited = [];
for ($i = 0; $i < 7; $i++) {
    $visited[$i] = false;
}

// Realiza a busca a partir do vértice 0
$graph->depthFirstSearch(0, $visited);
