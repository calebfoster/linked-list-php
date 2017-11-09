<?php

namespace calebfoster\Collections\LinkedList;

class Node
{
    /** @var float|int|string|object */
    public $value;

    /** @var Node */
    public $next;

    /**
     * Node constructor.
     *
     * @param int|float|string|object $value
     * @param Node|null $next
     */
    public function __construct($value, $next = null)
    {
        $this->value = $value;
        $this->next = $next;
    }
}