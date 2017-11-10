<?php

namespace calebfoster\Collections\LinkedList;

class Node
{
    /** @var float|int|string|object */
    public $item;

    /** @var Node */
    public $next;

    /**
     * Node constructor.
     *
     * @param int|float|string|object $item
     * @param Node|null $next
     */
    public function __construct($item, $next = null)
    {
        $this->item = $item;
        $this->next = $next;
    }
}