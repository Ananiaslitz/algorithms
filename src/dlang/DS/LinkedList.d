import std.stdio;

class Node {
    int data;
    Node next;

    this(int data) {
        this.data = data;
        this.next = null;
    }
}

class LinkedList {
    Node head;

    void append(int data) {
        Node newNode = new Node(data);
        if (head == null) {
            head = newNode;
            return;
        }
        Node temp = head;
        while (temp.next != null) {
            temp = temp.next;
        }
        temp.next = newNode;
    }

    void display() {
        Node temp = head;
        while (temp != null) {
            write(temp.data, " -> ");
            temp = temp.next;
        }
        writeln("null");
    }
}

void main() {
    LinkedList list = new LinkedList();
    list.append(10);
    list.append(20);
    list.append(30);
    list.display();  // Saída: 10 -> 20 -> 30 -> null
}
