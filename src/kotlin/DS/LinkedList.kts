class Node(var data: Int, var next: Node? = null)

class LinkedList {
    private var head: Node? = null

    fun append(data: Int) {
        val newNode = Node(data)
        if (head == null) {
            head = newNode
        } else {
            var temp = head
            while (temp?.next != null) {
                temp = temp.next
            }
            temp?.next = newNode
        }
    }

    fun display() {
        var temp = head
        while (temp != null) {
            print("${temp.data} -> ")
            temp = temp.next
        }
        println("null")
    }
}

fun main() {
    val list = LinkedList()
    list.append(10)
    list.append(20)
    list.append(30)
    list.display()  // Saída: 10 -> 20 -> 30 -> null
}
