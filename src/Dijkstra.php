<?php

declare(strict_types=1);

namespace App;

class Dijkstra
{
    private const INFINITY = 1e9;
    private array $used = [];
    private array $esum = [];
    private array $path = [];

    public function __construct(private Graph $graph)
    {
    }

    public function getShortesPath(string $frNode, string $toNode): string
    {
        $this->init();

        $this->esum[$frNode] = 0;
        while ($currNode = $this->findNearestUnusedNode()) {
            $this->setEsumToNextNodes($currNode);
        }
        return $this->restorePath($frNode, $toNode);
    }

    public function init()
    {
        foreach ($this->graph->getNodes() as $node) {
            $this->used[$node] = false;
            $this->esum[$node] = self::INFINITY;
            $this->path[$node] = '';
        }
    }

    public function findNearestUnusedNode(): string
    {
        $nearestNode = '';
        foreach ($this->graph->getNodes() as $node) {
            if (!$this->used[$node]) {
                if (
                    $nearestNode == '' ||
                    $this->esum[$node] < $this->esum[$nearestNode]
                ){
                    $nearestNode = $node;
                }
            }
        }
        return $nearestNode;
    }

    public function setEsumToNextNodes(string $currNode): void
    {
        $this->used[$currNode] = true;

        foreach ($this->graph->getEdges($currNode) as $nextNode => $length) {
            if(!$this->used[$nextNode]) {
                $newEsum = $this->esum[$currNode] + $length;
                if ($newEsum < $this->esum[$nextNode]) {
                    $this->esum[$nextNode] = $newEsum;
                    $this->path[$nextNode] = $currNode;
                }
            }
        }
    }

    public function restorePath(string $frNode, string $toNode): string
    {
        $path = $toNode;

        while ($toNode !== $frNode) {
            $toNode = $this->path[$toNode];
            $path = $toNode . $path;
        }

        return $path;
    }
}