object QuickSortDemo {
  def main(args: Array[String]): Unit = {
    val arr = Array(10, 80, 30, 90, 40, 50, 70)
    val sorter = new QuickSorter(arr)
    sorter.sort()
    println("Array ordenado: " + sorter.getSortedArray.mkString(", "))
  }
}

class QuickSorter(private var array: Array[Int]) {

  def sort(): Unit = {
    quickSort(0, array.length - 1)
  }

  def getSortedArray: Array[Int] = {
    array
  }

  private def quickSort(low: Int, high: Int): Unit = {
    if (low < high) {
      val pi = partition(low, high)
      quickSort(low, pi - 1)
      quickSort(pi + 1, high)
    }
  }

  private def partition(low: Int, high: Int): Int = {
    val pivot = array(high) // Pivô
    var i = low - 1

    for (j <- low until high) {
      if (array(j) < pivot) {
        i += 1
        swap(i, j)
      }
    }

    swap(i + 1, high)
    i + 1
  }

  private def swap(i: Int, j: Int): Unit = {
    val temp = array(i)
    array(i) = array(j)
    array(j) = temp
  }
}
