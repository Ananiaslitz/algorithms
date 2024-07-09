package main

import "sync"

type HashTable struct {
	items map[int][]Pessoa
	lock  sync.RWMutex
}

func hash(nome string) (key int) {
	for _, letra := range nome {
		key = 31*key + int(letra)
	}

	return
}

func (ht *HashTable) Put(pessoa Pessoa) int {
	ht.lock.Lock()
	defer ht.lock.Unlock()
	key := hash(pessoa.Nome)
	if ht.items == nil {
		ht.items = make(map[int][]Pessoa)
	}
	ht.items[key] = append(ht.items[key], pessoa)

	return key
}

func (ht *HashTable) Remove(nome string) {
	ht.lock.Lock()
	defer ht.lock.Unlock()

	key := hash(nome)
	delete(ht.items, key)
}

func (ht *HashTable) Get(key int) []Pessoa {
	ht.lock.RLock()
	defer ht.lock.RUnlock()

	return ht.items[key]
}

func (ht *HashTable) Search(nome string) []Pessoa {
	ht.lock.RLock()
	defer ht.lock.RUnlock()

	key := hash(nome)
	return ht.items[key]
}
