object LookupTableDemo extends App {
  val lookupTable: Map[String, Int] = Map("key1" -> 100, "key2" -> 200)
  println(lookupTable("key1"))  // Saída: 100
}
