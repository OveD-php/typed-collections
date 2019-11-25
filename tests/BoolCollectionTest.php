<?php


use Illuminate\Support\Str;
use PHPUnit\Framework\TestCase;
use PhpSafari\Collections\BoolCollection;
use PhpSafari\Exception\InvalidTypeException;
use PhpSafari\Collections\StringCollection;

class BoolCollectionTest extends TestCase
{

    /**
     * @test
     *
     */
    public function can_add_boolean_to_collection()
    {
        // Given
        $bools = [true, false];

        // When
        $collection = new BoolCollection($bools);

        // Then
        $this->assertEquals(2, $collection->count());
        $this->assertEquals($bools, $collection->toArray());
    }

    /**
     * @test
     *
     */
    public function cannot_add_a_non_bool_to_collection()
    {
        // Given
        $this->expectException(InvalidTypeException::class);
        $this->expectExceptionMessage("1 is not a boolean");

        // When
        $ints = [1, 2, 3, 4];

        // Then
        new BoolCollection($ints);
    }
}