<?php

use calebfoster\Collections\LinkedList;
use calebfoster\Collections\LinkedList\Node;

class LinkedListTest extends PHPUnit_Framework_TestCase
{
    const LINKED_LIST_CLASS = 'calebfoster\Collections\LinkedList';

    public function testPassingBuild()
    {
        $this->assertTrue(true);
    }

    public function testIsThereAnySyntaxError()
    {
        $var = new \calebfoster\Collections\LinkedList();
        $this->assertTrue(is_object($var));
        unset($var);
    }

    public function testAdd()
    {
        /** @var LinkedList\Node $node */

        // add constructor - scalar
        $list = new LinkedList(1);
        $node = $this->getPrivateProperty($list, 'head');
        $this->assertEquals(1, $list->count());
        $this->assertEquals(1, $node->item, 'Test "head" value from __construct(scalar)');

        // add constructor - Node
        $list = new LinkedList(new Node(1));
        $node = $this->getPrivateProperty($list, 'head');
        $this->assertEquals(1, $list->count());
        $this->assertEquals(1, $node->item, 'Test "head" value from __construct(Node)');

        // addFirst() - scalar
        $preCount = $list->count();
        $list->addFirst(2);
        $node = $this->getPrivateProperty($list, 'head');
        $this->assertEquals($preCount + 1, $list->count());
        $this->assertEquals(2, $node->item,'Test "head" value from addFirst(scalar)');

        // addFirst() - Node
        $preCount = $list->count();
        $list->addFirst(new Node(3));
        $node = $this->getPrivateProperty($list, 'head');
        $this->assertEquals($preCount + 1, $list->count());
        $this->assertEquals(3, $node->item, 'Test "head" value from addFirst(Node)');

        // addLast() - scalar
        $preCount = $list->count();
        $list->addLast(25);
        $node = $this->getPrivateProperty($list, 'tail');
        $this->assertEquals($preCount + 1, $list->count());
        $this->assertEquals(25, $node->item);

        // addLast() - Node
        $preCount = $list->count();
        $list->addLast(4);
        $node = $this->getPrivateProperty($list, 'tail');
        $this->assertEquals($preCount + 1, $list->count());
        $this->assertEquals(4, $node->item);
    }

    public function testRemoveFirst()
    {
        $list = $this->generateList();
        /** Node $head */
        $head = $this->getPrivateProperty($list, 'head');

        $head = $head->next;

        $preCount = $list->count();

        $list->removeFirst();
        $this->assertEquals($preCount - 1, $list->count());
        $this->assertEquals(2, $head->item);
    }

    public function testRemoveLast()
    {
        $list = $this->generateList();
        /** @var Node $tail */
        $node = $this->getPrivateProperty($list, 'head');
        $tail = $this->getPrivateProperty($list, 'tail');

        // get 2nd to last node
        while ($node->next !== $tail)
            $node = $node->next;

        $preCount = $list->count();

        $list->removeLast();
        $this->assertEquals($preCount - 1, $list->count());
        $this->assertEquals(4, $node->item);
    }

    public function testRemove()
    {
        $list = $this->generateList();
        $preCount = $list->count();
        $list->remove(3);
        $this->assertEquals($preCount - 1, $list->count());
    }

    public function testClear()
    {
        $list = $this->generateList();
        $list->clear();
        $this->assertAttributeEquals(0, 'count', $list);
        $this->assertAttributeEquals(null, 'head', $list);
        $this->assertAttributeEquals(null, 'tail', $list);
    }

    public function testContains()
    {
        $list = $this->generateList();

        // contains(scalar)
        $this->assertTrue($list->contains(3));

        // contains(Node)
        $node = new Node(8);
        $list->addLast($node);
        $this->assertTrue($list->contains($node));
    }


    /**
     * @return LinkedList
     */
    private function generateList() {
        $list = new LinkedList();
        $list
            ->addLast(1)
            ->addLast(2)
            ->addLast(3)
            ->addLast(4)
            ->addLast(5);
        return $list;
    }

    private function getPrivateProperty($instance, $propertyName) {
        return PHPUnit_Framework_Assert::readAttribute($instance, $propertyName);
    }


}