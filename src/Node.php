<?php

declare(strict_types=1);

namespace App;

class Node
{
    public function __construct(
        private string $item,
        private ?self $node = null
    ) {}

    public function getItem(): string
    {
        return $this->item;
    }

    public function getNext(): ?self
    {
        return $this->node;
    }

    public function setNode(self $node): void
    {
        $this->node = $node;
    }
}
