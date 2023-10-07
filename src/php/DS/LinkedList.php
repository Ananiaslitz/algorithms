<?php

class Node {
    public $data;
    public $next;

    public function __construct($data) {
        $this->data = $data;
        $this->next = null;
    }
}

class LinkedList {
    private $head;

    public function append($data) {
        $newNode = new Node($data);
        if ($this->head === null) {
            $this->head = $newNode;
            return;
        }
        $temp = $this->head;
        while ($temp->next !== null) {
            $temp = $temp->next;
        }
        $temp->next = $newNode;
    }

    public function display() {
        $temp = $this->head;
        while ($temp !== null) {
            echo $temp->data . " -> ";
            $temp = $temp->next;
        }
        echo "null\n";
    }
}

$list = new LinkedList();
$list->append(10);
$list->append(20);
$list->append(30);
$list->display();  // Saída: 10 -> 20 -> 30 -> null
