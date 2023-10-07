class Node(var data: Int, var next: Node = null)

class LinkedList {
  var head: Node = null

  def append(data: Int): Unit = {
    val newNode = new Node(data)
    if (head == null) {
      head = newNode
    } else {
      var temp = head
      while (temp.next != null) {
        temp = temp.next
      }
      temp.next = newNode
    }
  }

  def display(): Unit = {
    var temp = head
    while (temp != null) {
      print(s"${temp.data} -> ")
      temp = temp.next
    }
    println("null")
  }
}

object LinkedListDemo extends App {
  val list = new LinkedList
  list.append(10)
  list.append(20)
  list.append(30)
  list.display()  // Saída: 10 -> 20 -> 30 -> null
}
