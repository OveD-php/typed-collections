<?php

use Phpsafari\Collections\BoolCollection;
use Phpsafari\Collections\EmailCollection;
use Phpsafari\Collections\FloatCollection;
use Phpsafari\Collections\IntCollection;
use Phpsafari\Collections\NumberCollection;
use Phpsafari\Collections\StringCollection;
use Phpsafari\Collections\TypedCollection;

if (! function_exists('iCollect')) {
    function iCollect($value = null): IntCollection
    {
        return new IntCollection($value);
    }
}

if (! function_exists('sCollect')) {
    function sCollect($value = null): StringCollection
    {
        return new StringCollection($value);
    }
}

if (! function_exists('bCollect')) {
    function bCollect($value = null): BoolCollection
    {
        return new BoolCollection($value);
    }
}

if (! function_exists('fCollect')) {
    function fCollect($value = null): FloatCollection
    {
        return new FloatCollection($value);
    }
}

if (! function_exists('eCollect')) {
    function eCollect($value = null): EmailCollection
    {
        return new EmailCollection($value);
    }
}

if (! function_exists('nCollect')) {
    function nCollect($value = null): NumberCollection
    {
        return new NumberCollection($value);
    }
}
