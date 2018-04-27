<?php

namespace Shoprunback;

use Shoprunback\Error\ElementIndexDoesntExists;
use Shoprunback\ElementIterator;

class ElementManager extends \ArrayObject
{
    public function __construct($responseBody, $elementName)
    {
        $this->per_page     = 10;
        $this->next_page    = null;
        $this->current_page = 1;

        if (isset($responseBody->pagination)) {
            $this->count        = $responseBody->pagination->count;
            $this->per_page     = $responseBody->pagination->per_page;
            $this->next_page    = $responseBody->pagination->next_page;
            $this->current_page = $responseBody->pagination->current_page;

            $elementKey = $elementName::getAllElementKey();
            foreach ($responseBody->$elementKey as $element) {
                $this->elements[] = $elementName::newFromMixed($element);
            }
        } else {
            $this->count = count($responseBody);

            foreach ($responseBody as $element) {
                $this->elements[] = $elementName::newFromMixed($element);
            }
        }
    }

    public function count()
    {
        return count($this->elements);
    }

    public function getIterator()
    {
        return new ElementIterator($this);
    }

    public function offsetGet($index)
    {
        if (isset($this->elements[$index])) {
            return $this->elements[$index];
        }

        $elementClass = $this->getElementClass();
        if ($index < $this->count) {
            return $elementClass::all(floor($index / $this->per_page))[$index % $this->per_page];
        }

        throw new ElementIndexDoesntExists('There is ' . $this->count . ' ' . $elementClass::getAllElementKey() . ' and the number asked was ' . $index);
    }

    public function getElementClass()
    {
        return get_class($this[0]);
    }

    public function getLast()
    {
        return $this[$this->count - 1];
    }
}