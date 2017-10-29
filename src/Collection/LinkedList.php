<?php

namespace calebfoster\Collection;

/**
*  A sample class
*
*  Use this section to define what this class is doing, the PHPDocumentator will use this
*  to automatically generate an API documentation using this information.
*
*  @author Caleb Foster
*/
class LinkedList
{

    protected $head;

    protected $tail;

    protected $count;

    public function __construct($root = null)
    {
        $this->head = $this->tail = $root;
        $this->count = 0;
    }

    public function addFirst($node)
    {
        if (!$node instanceof Node)
            $node = new Node($node);

        $temp = $this->head;

        $this->head = $node;

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