<?php

namespace calebfoster\Collection\LinkedList;

class Node
{
    public $value;

    /** @var Node */
    public $next;

    public function __construct($value, $next = null)
    {
        $this->value = $value;
        $this->next = $next;
    }
}