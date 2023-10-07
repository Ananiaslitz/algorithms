import std.stdio;

class Node {
    int[] keys;
    Node[] children;
    bool leaf = true;
    int n;

    this(int t) {
        keys.length = 2 * t - 1;
        children.length = 2 * t;
        n = 0;
    }
}

class BTree {
    Node root;
    int t;

    this(int t) {
        this.t = t;
        root = new Node(t);
    }

    void traverse(Node x) {
        int i;
        for (i = 0; i < x.n; i++) {
            if (!x.leaf) {
                traverse(x.children[i]);
            }
            write(x.keys[i], " ");
        }

        if (!x.leaf) {
            traverse(x.children[i]);
        }
    }

    Node search(Node x, int k) {
        int i = 0;
        while (i < x.n && k > x.keys[i]) {
            i++;
        }

        if (i < x.n && k == x.keys[i]) {
            return x;
        } else if (x.leaf) {
            return null;
        } else {
            return search(x.children[i], k);
        }
    }

    void insert(int k) {
        Node r = root;
        if (r.n == 2*t - 1) {
            Node s = new Node(t);
            root = s;
            s.leaf = false;
            s.children[0] = r;
            splitChild(s, 0);
            insertNonFull(s, k);
        } else {
            insertNonFull(r, k);
        }
    }

    void insertNonFull(Node x, int k) {
        int i = x.n - 1;
        if (x.leaf) {
            while (i >= 0 && k < x.keys[i]) {
                x.keys[i + 1] = x.keys[i];
                i--;
            }
            x.keys[i + 1] = k;
            x.n++;
        } else {
            while (i >= 0 && k < x.keys[i]) i--;
            i++;
            if (x.children[i].n == 2*t - 1) {
                splitChild(x, i);
                if (k > x.keys[i]) i++;
            }
            insertNonFull(x.children[i], k);
        }
    }

    void splitChild(Node x, int i) {
        Node z = new Node(t);
        Node y = x.children[i];
        z.leaf = y.leaf;
        z.n = t - 1;
        
        for (int j = 0; j < t - 1; j++) {
            z.keys[j] = y.keys[j + t];
        }
        
        if (!y.leaf) {
            for (int j = 0; j < t; j++) {
                z.children[j] = y.children[j + t];
            }
        }
        
        y.n = t - 1;
        
        for (int j = x.n; j >= i + 1; j--) {
            x.children[j + 1] = x.children[j];
        }
        x.children[i + 1] = z;
        
        for (int j = x.n - 1; j >= i; j--) {
            x.keys[j + 1] = x.keys[j];
        }
        x.keys[i] = y.keys[t - 1];
        x.n++;
    }

    void remove(int k) {
        if (!root) {
            writeln("The tree is empty");
            return;
        }
        
        removeInternal(root, k);
        
        if (root.n == 0) {
            if (root.leaf) root = null;
            else root = root.children[0];
        }
        return;
    }

    void removeInternal(Node x, int k) {
        int idx = 0;
        while (idx < x.n && x.keys[idx] < k) ++idx;

        if (idx < x.n && x.keys[idx] == k) {
            if (x.leaf) removeFromLeaf(x, idx);
            else removeFromNonLeaf(x, idx);
        } else {
            if (x.leaf) {
                writeln("The key ", k, " does not exist in the tree");
                return;
            }

            bool flag = (idx == x.n);
            if (x.children[idx].n < t) fill(x, idx);

            if (flag && idx > x.n) removeInternal(x.children[idx - 1], k);
            else removeInternal(x.children[idx], k);
        }
        return;
    }

    void removeFromLeaf(Node x, int idx) {
        for (int i = idx + 1; i < x.n; ++i) x.keys[i - 1] = x.keys[i];
        x.n--;

        return;
    }

    void removeFromNonLeaf(Node x, int idx) {
        int k = x.keys[idx];

        if (x.children[idx].n >= t) {
            int pred = getPred(x, idx);
            x.keys[idx] = pred;
            removeInternal(x.children[idx], pred);
        } else if (x.children[idx + 1].n >= t) {
            int succ = getSucc(x, idx);
            x.keys[idx] = succ;
            removeInternal(x.children[idx + 1], succ);
        } else {
            merge(x, idx);
            removeInternal(x.children[idx], k);
        }
        return;
    }

    int getPred(Node x, int idx) {
        Node cur = x.children[idx];
        while (!cur.leaf) cur = cur.children[cur.n];

        return cur.keys[cur.n - 1];
    }

    int getSucc(Node x, int idx) {
        Node cur = x.children[idx + 1];
        while (!cur.leaf) cur = cur.children[0];

        return cur.keys[0];
    }

    void fill(Node x, int idx) {
        if (idx != 0 && x.children[idx - 1].n >= t) borrowFromPrev(x, idx);
        else if (idx != x.n && x.children[idx + 1].n >= t) borrowFromNext(x, idx);
        else {
            if (idx != x.n) merge(x, idx);
            else merge(x, idx - 1);
        }
        return;
    }

    void borrowFromPrev(Node x, int idx) {
        Node child = x.children[idx];
        Node sibling = x.children[idx - 1];

        for (int i = child.n - 1; i >= 0; --i) child.keys[i + 1] = child.keys[i];
        if (!child.leaf) {
            for (int i = child.n; i >= 0; --i) child.children[i + 1] = child.children[i];
        }

        child.keys[0] = x.keys[idx - 1];

        if (!x.leaf) child.children[0] = sibling.children[sibling.n];

        x.keys[idx - 1] = sibling.keys[sibling.n - 1];
        child.n += 1;
        sibling.n -= 1;

        return;
    }

    void borrowFromNext(Node x, int idx) {
        Node child = x.children[idx];
        Node sibling = x.children[idx + 1];

        child.keys[(child.n)] = x.keys[idx];

        if (!(child.leaf)) child.children[(child.n) + 1] = sibling.children[0];

        x.keys[idx] = sibling.keys[0];

        for (int i = 1; i < sibling.n; ++i) sibling.keys[i - 1] = sibling.keys[i];
        if (!sibling.leaf) {
            for (int i = 1; i <= sibling.n; ++i) sibling.children[i - 1] = sibling.children[i];
        }

        child.n += 1;
        sibling.n -= 1;

        return;
    }

    void merge(Node x, int idx) {
        Node child = x.children[idx];
        Node sibling = x.children[idx + 1];

        child.keys[t - 1] = x.keys[idx];

        for (int i = 0; i < sibling.n; ++i) child.keys[i + t] = sibling.keys[i];

        if (!child.leaf) {
            for (int i = 0; i <= sibling.n; ++i) child.children[i + t] = sibling.children[i];
        }

        for (int i = idx + 1; i < x.n; ++i) x.keys[i - 1] = x.keys[i];
        for (int i = idx + 2; i <= x.n; ++i) x.children[i - 1] = x.children[i];

        child.n += sibling.n + 1;
        x.n--;

        return;
    }
}


void main() {
    auto tree = new BTree(3);
    tree.insert(10);
    tree.insert(20);
    tree.remove(10);
    tree.traverse(tree.root);
}