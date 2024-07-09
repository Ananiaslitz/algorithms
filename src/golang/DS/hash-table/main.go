package main

import "fmt"

type Pessoa struct {
	Nome      string
	Sobrenome string
	Idade     int
	Sexo      string
}

func main() {
	pessoas := []Pessoa{
		{"Diego", "Ananias", 33, "M"},
		{"Diego", "Sebastiao", 33, "M"},
		{"Augusto", "Ananias", 1, "M"},
		{"Antonio", "Ananias", 5, "M"},
		{"Carinna", "Caetano", 36, "F"},
		{"Isadora", "Caetano", 11, "F"},
	}

	table := HashTable{}

	keys := make([]int, len(pessoas))

	for i, pessoa := range pessoas {
		keys[i] = table.Put(pessoa)
	}

	for _, key := range keys {
		ps := table.Get(key)
		for _, p := range ps {
			fmt.Println(p.Nome, p.Sobrenome)
		}
	}

	table.Remove("Isadora")

	degas := table.Search("Diego")

	fmt.Println(degas)
}
