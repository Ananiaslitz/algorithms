import std.stdio;

void main() {
    int[string] lookupTable;
    lookupTable["key1"] = 100;
    lookupTable["key2"] = 200;
    writeln(lookupTable["key1"]);  // Saída: 100
}
