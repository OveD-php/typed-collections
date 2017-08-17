<?php

namespace Phpsafari\Collections;

class NumberCollection extends TypedCollection
{
    protected function isValidItem($item): bool
    {
        return is_float($item) || is_integer($item) || is_int($item);
    }

    public function getErrorMsg($item): string
    {
        return sprintf('%s is not a number', $item);
    }
}
