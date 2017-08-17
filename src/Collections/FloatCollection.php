<?php

namespace Phpsafari\Collections;

class FloatCollection extends TypedCollection
{
    protected function isValidItem($item): bool
    {
        return is_float($item);
    }

    public function getErrorMsg($item): string
    {
        return sprintf('%s is not a valid float', $item);
    }
}
