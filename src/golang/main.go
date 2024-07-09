package main

import "fmt"

func main() {
	itens := []int{109, 1234, 123, 12, 1, 5, 67, 7}

	bubblesort_simple(itens)

	bubblesort(itens)
	fmt.Println("#########################################")
	items := []int{109, 1234, 123, 12, 1, 5, 67, 7}

	sortedItems := quicksort(items)
	fmt.Println(sortedItems)
}

func quicksort(items []int) []int {
	if len(items) <= 1 {
		return items
	}

	pivot := items[0]
	left, right := []int{}, []int{}

	for _, item := range items[1:] {
		if item < pivot {
			left = append(left, item)
		} else {
			right = append(right, item)
		}
	}

	left = quicksort(left)
	right = quicksort(right)

	return append(append(left, pivot), right...)
}

func bubblesort_simple(itens []int) {
	for i := 0; i <= len(itens)-1; i++ {
		for index := 0; index < len(itens)-i-1; index++ {
			if itens[index] > itens[index+1] {
				itens[index], itens[index+1] = itens[index+1], itens[index]
			}
		}
	}

	fmt.Println(itens)
}

func bubblesort(itens []int) {
	n := len(itens)
	swapped := true

	for swapped {
		swapped = false

		for i := 0; i < n-1; i++ {
			if itens[i] > itens[i+1] {
				itens[i], itens[i+1] = itens[i+1], itens[i]
				swapped = true
			}
		}
	}

	fmt.Println(itens)
}
