<?php

namespace Phpsafari\Collections;

use Illuminate\Support\Collection;
use Phpsafari\Exception\InvalidTypeException;

abstract class TypedCollection extends Collection
{

    protected $type;

    /**
     * Create a object and add items
     * @param null $items
     */
    public function __construct($items = null)
    {
        $items = $this->getArrayableItems($items);

        $this->addMultiple($items);
    }

    /**
     * Add an array
     *
     * @param array $array
     */
    private function addMultiple(array $array)
    {
        array_map(function($item){
            $this->offsetSet(null, $item);
        }, $array);
    }

    /**
     * Is the item valid - overwrite if you need another check
     *
     * @param $item
     * @return bool
     */
    protected function isValidItem($item): bool
    {
        return is_a($item, $this->type);
    }

    /**
     * get the error msg
     *
     * @param $item
     * @return string
     */
    protected function getErrorMsg($item): string
    {
        if (is_object($item)) {
            return sprintf("Item '%s' is not a %s object!", get_class($item), $this->type);
        } elseif (is_array($item)) {
            return sprintf("Item (%s) '%s' is not a %s object!", gettype($item), print_r($item, true), $this->type);
        }

        return sprintf("Item (%s) '%s' is not a %s object!", gettype($item), $item, $this->type);
    }

    /**
     * Set the item at a given offset. Overrides the Collection basic method and check if its a valid type
     *
     * @param  mixed $key
     * @param  mixed $value
     * @throws InvalidTypeException
     */
    public function offsetSet($key, $value)
    {
        if (!$this->isValidItem($value)) {
            throw new InvalidTypeException($this->getErrorMsg($value));
        }

        parent::offsetSet($key, $value);
    }

    /**
     * Return this typed collection as a plain collection.
     *
     * @return Collection
     */
    public function toCollection(): Collection
    {
        return collect($this->toArray());
    }
}
