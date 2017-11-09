<?php

namespace calebfoster\Collections;

use calebfoster\Collections\LinkedList\Node;

/**
*  LinkedList Class
*
*  @author Caleb Foster
*/
class LinkedList implements \Iterator
{

    /** @var Node */
    protected $head;

    /** @var  Node */
    protected $tail;

    /** @var int */
    protected $count;

    /** @var Node */
    private $current;

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

        if ($this->count === 0) {
            $this->head = $node;
        }
        else {
            $this->tail->next = $node;
        }

        $this->tail = $node;
        $this->count++;

        return $this;
    }

    public function removeFirst()
    {
        if ($this->count !== 0) {
            $this->head = $this->head->next;
            $this->count--;

            if ($this->count === 0)
                $this->tail = null;
        }
    }

    /**
     * @return LinkedList
     */
    public function removeLast()
    {
        if ($this->count !== 0) {
            if ($this->count === 1) {
                $this->head = $this->tail = null;
            }
            else {
                $current = $this->head;
                while ($current->next !== $this->tail)
                    $current = $current->next;

                $current->next = null;
                $this->tail = $current;
            }

            $this->count--;
        }

        return $this;
    }

    /**
     * Return the current element
     * @link http://php.net/manual/en/iterator.current.php
     * @return mixed Can return any type.
     * @since 5.0.0
     */
    public function current()
    {
        return $this->current;
    }

    /**
     * Move forward to next element
     * @link http://php.net/manual/en/iterator.next.php
     * @return void Any returned value is ignored.
     * @since 5.0.0
     */
    public function next()
    {
        $this->current = $this->current->next;
    }

    /**
     * Return the key of the current element
     * @link http://php.net/manual/en/iterator.key.php
     * @return mixed scalar on success, or null on failure.
     * @since 5.0.0
     */
    public function key()
    {
        // TODO: Implement key() method.
    }

    /**
     * Checks if current position is valid
     * @link http://php.net/manual/en/iterator.valid.php
     * @return boolean The return value will be casted to boolean and then evaluated.
     * Returns true on success or false on failure.
     * @since 5.0.0
     */
    public function valid()
    {
        return !!$this->current;
    }

    /**
     * Rewind the Iterator to the first element
     * @link http://php.net/manual/en/iterator.rewind.php
     * @return void Any returned value is ignored.
     * @since 5.0.0
     */
    public function rewind()
    {
        $this->current = $this->head;
    }
}