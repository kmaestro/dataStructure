<?php

declare(strict_types=1);

namespace App;

class Stack extends Sequence
{
    private ?Node $last = null;

    public function put(string $item): void
    {
        $this->last = new Node($item, $this->last);
    }

    public function get(): ?string
    {
        if ($this->isEmpty()) {
            return null;
        }
        $item = $this->last->getItem();
        $this->last = $this->last->getNext();
        return $item;
    }

    protected function getFirst(): ?Node
    {
        return $this->last;
    }

    public function isEmpty(): bool
    {
        return $this->last === null;
    }
}
