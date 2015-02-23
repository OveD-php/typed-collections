<?php


namespace Vistik\Lists;


class EmailArray extends TypeHintedArray
{

    protected function isValidItem($item)
    {
        return filter_var($item, FILTER_VALIDATE_EMAIL) !== false;
    }

    public function getErrorMsg($item)
    {
        return sprintf('%s is not a valid email address', $item);
    }
}