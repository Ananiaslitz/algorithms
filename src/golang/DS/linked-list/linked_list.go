package main

import "fmt"

type List struct {
	Head *Node
	Tail *Node
}

func (l *List) Append(pessoa Pessoa) {
	node := &Node{Value: pessoa}
	if l.Head == nil {
		l.Head = node
	}

	if l.Tail != nil {
		l.Tail.Next = node
	}

	l.Tail = node
}

func (l *List) Search(nome string) (pessoa Pessoa) {
	node := l.Head

	for node != nil {
		if node.Value.Nome == nome {
			pessoa = node.Value
			break
		}

		node = node.Next
	}

	if node != nil {
		return node.Value
	}

	return
}

func (l *List) Display() {
	node := l.Head

	for node != nil {
		fmt.Println(node.Value.Nome)

		node = node.Next
	}
}

func (l *List) Delete(nome string) {
	if l.Head.Value.Nome == nome {
		l.Head = l.Head.Next
		return
	}

	prev := l.Head
	node := l.Head.Next

	for node != nil {
		if node.Value.Nome == nome {
			prev.Next = node.Next
			break
		}

		prev = node
		node = node.Next
	}

	if l.Tail == node {
		l.Tail = prev
	}
}

type Node struct {
	Value Pessoa
	Next  *Node
}
