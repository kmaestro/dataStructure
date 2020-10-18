<?php

declare(strict_types=1);

namespace App;

use function PHPUnit\Framework\isEmpty;

class Walker
{
    public array $path = [];

    public function __construct(
        private Graph $graph
    ) {}

    public function walkDepth(string $node)
    {
        $this->path[$node] = true;
        foreach ($this->graph->getEdges($node) as $node2 => $length) {
            if (!isset($this->path[$node2])) {
                $this->walkDepth($node2);
            }
        }
    }

    public function walk(string $node, Sequence $sequence): array
    {
        $path = [];
        $sequence->put($node);
        while (!$sequence->isEmpty()) {
            $curr = $sequence->get();
            $path[$curr] = true;
            foreach ($this->graph->getEdges($node) as $node2 => $length) {
                if (!$path[$node2]) {
                    if (!$sequence->contains($node2)) {
                        $sequence->put($node2);
                    }
                }
            }
        }
        return $path;
    }
}
