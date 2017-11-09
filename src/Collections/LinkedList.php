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
     * Converts a value to a Node
     *
     * @param Node|int|float|string $value
     * @return Node
     */
    private function toNode($value) {
        if (!$value instanceof Node)
            $value = new Node($value);
        
        return $value;
    }

    /**
     * @param Node|int|float|string $node
     *
     * @return LinkedList
     */
    public function addFirst($node)
    {
        $node = $this->toNode($node);

        $temp = $this->head;

        $this->head = $node;
        $this->head->next = $temp;

        $this->count++;

        if ($this->count === 1)
            $this->tail = $this->head;

        return $this;
    }

    /**
     * @param Node|int|float|string $node
     *
     * @return LinkedList
     */
    public function addLast($node)
    {
        $node = $this->toNode($node);

        if (!$this->count) {
            $this->head = $node;
        }
        else {
            $this->tail->next = $node;
        }

        $this->tail = $node;
        $this->count++;

        return $this;
    }
}