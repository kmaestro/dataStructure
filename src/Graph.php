<?php

declare(strict_types=1);

namespace App;

class Graph
{
    private array $edges = [];

    public function addNode(string $node): void
    {
        $this->edges[$node] = [];
    }

    public function addEdge(string $node1, string $node2, int $length): void
    {
        $this->edges[$node1][$node2] = $length;
        $this->edges[$node2][$node1] = $length;
    }

    public function getNodes(): iterable
    {
        foreach ($this->edges as $node => $edge) {
            yield $node;
        }
    }

    public function getEdges(string $node1): iterable
    {
        foreach ($this->edges[$node1] as $node2 => $length) {
            yield $node2 => $length;
        }
    }
}
