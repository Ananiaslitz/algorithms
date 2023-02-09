class BinarySearch {
    private var list: List<Int>

    constructor(list: List<Int>) {
        this.list = list.sorted()
    }

    fun search(target: Int): Int {
        var left = 0
        var right = list.size - 1
        while (left <= right) {
            val mid = (left + right) / 2
            when {
                list[mid] == target -> return mid
                list[mid] < target -> left = mid + 1
                else -> right = mid - 1
            }
        }
        return -1
    }
}
