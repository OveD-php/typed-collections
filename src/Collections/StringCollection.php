<?php

namespace Vistik\Collections;

class StringCollection extends TypedCollection
{

    protected function isValidItem($item): bool
    {
        return is_string($item);
    }

    public function getErrorMsg($item): string
    {
        return sprintf('%s is not a string', $item);
    }
}
