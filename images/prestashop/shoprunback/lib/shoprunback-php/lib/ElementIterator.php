<?php

namespace Shoprunback;

use Shoprunback\Error\ElementIndexDoesntExists;

class ElementIterator implements \Iterator, \ArrayAccess
{
    // Implements Iterator
    private $position = 0;
    public $manager;

    public function __construct($manager)
    {
        $this->manager      = $manager;
        $this->per_page     = $manager->per_page;
        $this->next_page    = $manager->next_page;
        $this->current_page = $manager->current_page;
    }

    public function next()
    {
        if ($this->position == ($this->per_page - 1) && isset($this->current_page) && !is_null($this->next_page)) {
            $managerClass = $this->manager->getElementClass();
            $this->position     = 0;
            $this->manager      = $managerClass::all($this->next_page);
            $this->per_page     = $this->manager->per_page;
            $this->next_page    = $this->manager->next_page;
            $this->current_page = $this->manager->current_page;
        } else {
            $this->position++;
        }
    }

    public function valid()
    {
        return isset($this->manager->elements[$this->position]);
    }

    public function current()
    {
        return $this->manager->elements[$this->position];
    }

    public function key()
    {
        return $this->position;
    }

    public function rewind()
    {
        $this->position = 0;
    }

    // Implements ArrayAccess
    public function offsetSet($offset, $value) {
        if (is_null($offset)) {
            $this->manager->elements[] = $value;
        } else {
            $this->manager->elements[$offset] = $value;
        }
    }

    public function offsetExists($offset) {
        return isset($this->manager->elements[$offset]);
    }

    public function offsetUnset($offset) {
        unset($this->manager->elements[$offset]);
    }

    public function offsetGet($offset) {
        return $this->offsetExists($offset) ? $this->manager->elements[$offset] : null;
    }
}