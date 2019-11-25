<?php

namespace PhpSafari\Collections;

class EmailCollection extends TypedCollection
{
    protected function isValidItem($item): bool
    {
        return filter_var($item, FILTER_VALIDATE_EMAIL) !== false;
    }

    public function getErrorMsg($item): string
    {
        return sprintf('%s is not a valid email address', $item);
    }
}
