<?php

namespace Vistik\Collections;

class BoolCollection extends TypedCollection
{
    protected function isValidItem($item): bool
    {
        return is_bool($item);
    }

    public function getErrorMsg($item): string
    {
        return sprintf('%s is not a boolean', $item);
    }
}
