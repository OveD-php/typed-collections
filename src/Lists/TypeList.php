<?php

namespace Vistik\Lists;

use Illuminate\Support\Collection;
use Vistik\Exception\InvalidTypeException;

abstract class TypeList extends Collection
{

    protected $type;

    /**
     * Create a object and add items
     */
    public function __construct()
    {
        $items = func_get_args();
        foreach ($items as $item){
            $this->put(null, $item);
        }
    }

    /**
     * Is the item valid
     *
     * @param $item
     * @return bool
     */
    protected function isValidItem($item)
    {
        return is_a($item, $this->type);
    }

    /**
     * get the error msg
     *
     * @param $item
     * @return string
     */
    protected function getErrorMsg($item)
    {
        if (is_object($item)) {
            return sprintf("Item '%s' is not a %s object!", get_class($item), $this->type);
        } elseif (is_array($item)) {
            return sprintf("Item (%s) '%s' is not a %s object!", gettype($item), print_r($item, true), $this->type);
        } else {
            return sprintf("Item (%s) '%s' is not a %s object!", gettype($item), $item, $this->type);
        }
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
        if (is_null($key)) {
            $this->items[] = $value;
        } else {
            $this->items[$key] = $value;
        }
    }


}
