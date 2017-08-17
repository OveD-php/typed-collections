<?php

namespace Phpsafari\Collections;

class IntCollection extends TypedCollection
{
    protected function isValidItem($item): bool
    {
        return is_integer($item);
    }

    public function getErrorMsg($item): string
    {
        return sprintf('%s is not a valid int', $item);
    }
}
