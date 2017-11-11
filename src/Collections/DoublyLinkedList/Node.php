<?php

namespace calebfoster\Collections\DoublyLinkedList;

class Node extends \calebfoster\Collections\LinkedList\Node
{

    /** @var Node */
    public $previous;

    /**
     * Node constructor.
     *
     * @param int|float|string|object $item
     * @param Node|null $next
     * @param Node|null $previous
     */
    public function __construct($item, $next = null, $previous = null)
    {
        parent::__construct($item, $next);
        $this->previous = $previous;
    }
}