<?php

namespace calebfoster\Collections\LinkedList;

class Node
{
    public $value;

    /** @var Node */
    public $next;

    /**
     * Node constructor.
     *
     * @param int|float|string $value
     * @param Node|null $next
     */
    public function __construct($value, $next = null)
    {
        $this->value = $value;
        $this->next = $next;
    }
}