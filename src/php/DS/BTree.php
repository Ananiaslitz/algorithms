<?php

class BTreeNode {
    public $keys = [];
    public $childPointers = [];
    public $numKeys = 0;
    public $isLeaf = true;
    public $treeDegree;

    public function __construct($treeDegree) {
        $this->treeDegree = $treeDegree;
    }
}

class BTree {
    private $root;
    private $treeDegree;

    public function __construct($treeDegree) {
        $this->root = new BTreeNode($treeDegree);
        $this->treeDegree = $treeDegree;
    }

    public function traverseTree() {
        $this->traverseNode($this->root);
    }

    private function traverseNode($node) {
        for ($idx = 0; $idx < $node->numKeys; $idx++) {
            if (!$node->isLeaf) {
                $this->traverseNode($node->childPointers[$idx]);
            }
            echo $node->keys[$idx] . " ";
        }
        if (!$node->isLeaf) {
            $this->traverseNode($node->childPointers[$idx]);
        }
    }

    public function insertKey($key) {
        $rootNode = $this->root;
        if ($rootNode->numKeys == (2 * $this->treeDegree) - 1) {
            $newNode = new BTreeNode($this->treeDegree);
            $this->root = $newNode;
            $newNode->isLeaf = false;
            $newNode->numKeys = 0;
            $newNode->childPointers[0] = $rootNode;
            $this->splitChild($newNode, 0, $rootNode);
            $this->insertNonFull($newNode, $key);
        } else {
            $this->insertNonFull($rootNode, $key);
        }
    }

    private function splitChild($parentNode, $childIndex, $childNode) {
        $treeDegree = $this->treeDegree;
        $newNode = new BTreeNode($treeDegree);
        $parentNode->childPointers[$parentNode->numKeys + 1] = $parentNode->childPointers[$parentNode->numKeys];
        for ($j = $parentNode->numKeys; $j > $childIndex; $j--) {
            $parentNode->keys[$j] = $parentNode->keys[$j - 1];
            $parentNode->childPointers[$j] = $parentNode->childPointers[$j - 1];
        }
        $parentNode->childPointers[$childIndex + 1] = $newNode;
        $parentNode->keys[$childIndex] = $childNode->keys[$treeDegree - 1];
        $parentNode->numKeys++;

        $newNode->isLeaf = $childNode->isLeaf;
        $newNode->numKeys = $treeDegree - 1;

        for ($j = 0; $j < $treeDegree - 1; $j++) {
            $newNode->keys[$j] = $childNode->keys[$j + $treeDegree];
        }
        if (!$childNode->isLeaf) {
            for ($j = 0; $j < $treeDegree; $j++) {
                $newNode->childPointers[$j] = $childNode->childPointers[$j + $treeDegree];
            }
        }
        $childNode->numKeys = $treeDegree - 1;
    }

    private function insertNonFull($node, $key) {
        $index = $node->numKeys;
        if ($node->isLeaf) {
            while ($index >= 1 && $key < $node->keys[$index - 1]) {
                $node->keys[$index] = $node->keys[$index - 1];
                $index--;
            }
            $node->keys[$index] = $key;
            $node->numKeys++;
        } else {
            while ($index >= 1 && $key < $node->keys[$index - 1]) {
                $index--;
            }
            $index++;
            if ($node->childPointers[$index - 1]->numKeys == (2 * $this->treeDegree) - 1) {
                $this->splitChild($node, $index - 1, $node->childPointers[$index - 1]);
                if ($key > $node->keys[$index - 1]) {
                    $index++;
                }
            }
            $this->insertNonFull($node->childPointers[$index - 1], $key);
        }
    }

    public function searchKey($key) {
        return $this->search($this->root, $key);
    }

    private function search($node, $key) {
        $i = 0;
        while ($i < $node->numKeys && $key > $node->keys[$i]) {
            $i++;
        }
        if ($i < $node->numKeys && $key == $node->keys[$i]) {
            return true;
        } elseif ($node->isLeaf) {
            return false; // Chave não esta presente e chegamos num nó do tipo folha
        } else {
            return $this->search($node->childPointers[$i], $key); // Continuando a pesquisa nos nós filhos.
        }
    }

    public function height() {
        return $this->getHeight($this->root);
    }

    private function getHeight($node) {
        if ($node->isLeaf) {
            return 1;
        }

        return 1 + $this->getHeight($node->childPointers[0]);
    }

    public function isEmpty() {
        return $this->root->numKeys == 0;
    }

    public function size() {
        return $this->getSize($this->root);
    }

    private function getSize($node) {
        $size = $node->numKeys;
        if (!$node->isLeaf) {
            for ($i = 0; $i <= $node->numKeys; $i++) {
                $size += $this->getSize($node->childPointers[$i]);
            }
        }
        return $size;
    }

    public function clear() {
        $this->root = new BTreeNode($this->treeDegree);
    }
}
