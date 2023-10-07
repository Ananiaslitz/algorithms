import std.stdio;

class QuickSorter {
    private int[] array;

    this(int[] arr) {
        this.array = arr.dup;  // Faz uma cópia do array original
    }

    public void sort() {
        quickSort(0, array.length - 1);
    }

    public int[] getSortedArray() {
        return array;
    }

    private void quickSort(int low, int high) {
        if (low < high) {
            int pi = partition(low, high);

            quickSort(low, pi - 1);
            quickSort(pi + 1, high);
        }
    }

    private int partition(int low, int high) {
        int pivot = array[high];  // Pivô
        int i = (low - 1);

        for (int j = low; j <= high - 1; j++) {
            if (array[j] < pivot) {
                i++;
                swap(i, j);
            }
        }

        swap(i + 1, high);
        return (i + 1);
    }

    private void swap(int i, int j) {
        int temp = array[i];
        array[i] = array[j];
        array[j] = temp;
    }
}

void main() {
    int[] arr = [10, 80, 30, 90, 40, 50, 70];
    QuickSorter sorter = new QuickSorter(arr);

    sorter.sort();
    writeln("Array ordenado: ", sorter.getSortedArray());
}
