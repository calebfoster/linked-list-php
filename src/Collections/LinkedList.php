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
        $node = $this->toNode($root);

        $this->head = $this->tail = $node;
        $this->count = 0;
    }

    /**
     * Converts an item to a Node
     *
     * @param Node|int|float|string $item
     * @return Node
     */
    private function toNode($item) {
        if (!$item instanceof Node)
            $item = new Node($item);
        
        return $item;
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

    /**
     * @param $item
     * @return bool
     */
    public function remove($item)
    {
        /** @var Node $previous */
        $previous = null;
        $current = $this->head;

        while ($current != null) {
            // TODO: add type detection or comparator
            if ($current->item === $item) {
                // node is not the first node
                if ($previous != null) {
                    $previous->next = $current->next;

                    // it was the end, update the tail
                    if ($current->next === null)
                        $this->tail = $previous;

                    $this->count--;
                }
                else
                {
                    $this->removeFirst();
                }

                return true;
            }

            $previous = $current;
            $current = $current->next;
        }

        return false;
    }

    /**
     * @return LinkedList
     */
    public function removeFirst()
    {
        if ($this->count !== 0) {
            $this->head = $this->head->next;
            $this->count--;

            if ($this->count === 0)
                $this->tail = null;
        }

        return $this;
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
     * Removes all item from the list
     * TODO: make sure PHP gc actually cleans up all items
     */
    public function clear()
    {
        $this->head = null;
        $this->tail = null;
        $this->count = 0;
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