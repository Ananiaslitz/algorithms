package main

import "fmt"

type Pessoa struct {
	Nome      string
	Sobrenome string
	Idade     int8
}

func main() {
	list := List{}

	degas := Pessoa{"Diego", "Ananias", 33}
	carinna := Pessoa{"Carinna", "Caetano", 36}
	maria := Pessoa{"Maria", "Caetano", 36}
	joao := Pessoa{"Joao", "Caetano", 36}
	antonio := Pessoa{"Antonio", "Caetano", 36}
	augusto := Pessoa{"Augusto", "Caetano", 36}

	list.Append(degas)
	list.Append(carinna)
	list.Append(maria)
	list.Append(joao)
	list.Append(antonio)
	list.Append(augusto)

	list.Display()

	fmt.Println("---------------------------------")

	pessoa := list.Search("Augusto")

	fmt.Println(pessoa)

	fmt.Println("---------------------------------")
	list.Delete("Antonio")

	list.Display()
}
