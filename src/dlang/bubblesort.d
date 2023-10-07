import std.stdio;

class BubbleSorter {
    private int[] array;

    this(int[] arr) {
        this.array = arr.dup;  // Cria uma cópia do array passado
    }

    void sort() {
        int n = array.length;
        bool swapped;
        do {
            swapped = false;
            for (int i = 0; i < n - 1; i++) {
                if (array[i] > array[i + 1]) {
                    swap(i, i + 1);
                    swapped = true;
                }
            }
        } while (swapped);
    }

    int[] getSortedArray() {
        return array;
    }

    private void swap(int i, int j) {
        int temp = array[i];
        array[i] = array[j];
        array[j] = temp;
    }
}

void main() {
    int[] arr = [64, 34, 25, 12, 22, 11, 90];
    BubbleSorter sorter = new BubbleSorter(arr);
    sorter.sort();
    writeln("Array ordenado: ", sorter.getSortedArray());
}
