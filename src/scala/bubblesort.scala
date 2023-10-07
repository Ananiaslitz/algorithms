object BubbleSortDemo {
  def main(args: Array[String]): Unit = {
    val arr = Array(64, 34, 25, 12, 22, 11, 90)
    val sorter = new BubbleSorter(arr)
    sorter.sort()
    println("Array ordenado: " + sorter.getSortedArray.mkString(", "))
  }
}

class BubbleSorter(private var array: Array[Int]) {

  def sort(): Unit = {
    val n = array.length
    var swapped = false
    do {
      swapped = false
      for (i <- 0 until n - 1) {
        if (array(i) > array(i + 1)) {
          swap(i, i + 1)
          swapped = true
        }
      }
    } while (swapped)
  }

  def getSortedArray: Array[Int] = {
    array
  }

  private def swap(i: Int, j: Int): Unit = {
    val temp = array(i)
    array(i) = array(j)
    array(j) = temp
  }
}
