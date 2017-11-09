<?php

namespace calebfoster\Collections;

use calebfoster\Collections\LinkedList\Node;

/**
*  LinkedList Class
*
*  @author Caleb Foster
*/
class LinkedList
{

    /** @var Node */
    protected $head;

    /** @var  Node */
    protected $tail;

    /** @var int */
    protected $count;

    public function __construct($root = null)
    {
        $this->head = $this->tail = $root;
        $this->count = 0;
    }

    /**
     * @param Node|int|float|string $node
     */
    public function addFirst($node)
    {
        if (!$node instanceof Node)
            $node = new Node($node);

        $temp = $this->head;

        $this->head = $node;
        $this->head->next = $temp;

        $this->count++;

        if ($this->count === 1)
            $this->tail = $this->head;
    }

    public function addLast($node)
    {
        if (!$this->count) {
            $this->head = $node;
        }
    }
}