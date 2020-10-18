<?php

require __DIR__ . '/vendor/autoload.php';

//$stack = new \App\Stack();
//$stack->put('John');
//$stack->put('Alex');
//$stack->put('Mike');
//
//var_dump($stack->get());
//var_dump($stack->get());
//var_dump($stack->get());
//
//$queue = new \App\Queue();
//$queue->put('John');
//$queue->put('Alex');
//$queue->put('Mike');
//
//var_dump($queue->get());
//var_dump($queue->get());
//var_dump($queue->get());

$graph = new \App\Graph();
$graph->addNode('A');
$graph->addNode('B');
$graph->addNode('C');
$graph->addNode('D');
$graph->addNode('E');
$graph->addNode('F');
$graph->addNode('G');

$graph->addEdge('A', 'B', 2);
$graph->addEdge('A', 'C', 3);
$graph->addEdge('A', 'D', 6);
$graph->addEdge('B', 'C', 4);
$graph->addEdge('B', 'E', 9);
$graph->addEdge('C', 'D', 1);
$graph->addEdge('C', 'F', 6);
$graph->addEdge('D', 'F', 4);
$graph->addEdge('E', 'F', 1);
$graph->addEdge('E', 'G', 5);
$graph->addEdge('F', 'G', 8);

foreach ($graph->getNodes() as $node) {
    var_dump($node);
}

$node1 = 'A';
foreach ($graph->getEdges($node1) as $edge => $length) {
    var_dump($node1 . ' - ' . $edge . ' - ' . $length);
}

//$walker = new \App\Walker($graph);
//print_r($walker->walk('C', new \App\Stack()));

//print_r($walker->path);

$d = new \App\Dijkstra($graph);

var_dump($d->getShortesPath('A', 'G'));