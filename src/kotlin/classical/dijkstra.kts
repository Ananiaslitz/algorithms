class Vertex(val name: String, var distance: Int = Int.MAX_VALUE)

class Edge(val start: Vertex, val end: Vertex, val weight: Int)

class Dijkstra {
    private var vertices = mutableMapOf<String, Vertex>()
    private var edges = mutableListOf<Edge>()

    fun addVertex(name: String) {
        vertices[name] = Vertex(name)
    }

    fun addEdge(startName: String, endName: String, weight: Int) {
        val start = vertices[startName] ?: throw IllegalArgumentException("Vertex $startName not found")
        val end = vertices[endName] ?: throw IllegalArgumentException("Vertex $endName not found")
        edges.add(Edge(start, end, weight))
    }

    fun shortestPath(startName: String) {
        val start = vertices[startName] ?: throw IllegalArgumentException("Start vertex $startName not found")
        val queue = PriorityQueue<Vertex>(compareBy { it.distance })
        start.distance = 0
        queue.addAll(vertices.values)
        while (queue.isNotEmpty()) {
            val current = queue.poll()
            if (current.distance == Int.MAX_VALUE) break
            for (edge in edges) {
                if (edge.start == current) {
                    val end = edge.end
                    val newDistance = current.distance + edge.weight
                    if (newDistance < end.distance) {
                        queue.remove(end)
                        end.distance = newDistance
                        queue.add(end)
                    }
                }
            }
        }
    }

    fun getShortestDistance(endName: String): Int {
        val end = vertices[endName] ?: throw IllegalArgumentException("End vertex $endName not found")
        return end.distance
    }
}
