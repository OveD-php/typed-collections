<?php


use Illuminate\Support\Str;
use PHPUnit\Framework\TestCase;
use Phpsafari\Exception\InvalidTypeException;
use Phpsafari\Collections\StringCollection;

class StringCollectionTest extends TestCase
{

    /**
     * @test
     *
     */
    public function can_add_string_to_collection()
    {
        // Given
        $strings = [Str::random(), Str::random(), Str::random(), Str::random()];

        // When
        $collection = new StringCollection($strings);

        // Then
        $this->assertEquals(4, $collection->count());
        $this->assertEquals($strings, $collection->toArray());
    }

    /**
     * @test
     *
     */
    public function cannot_add_a_non_string_to_collection()
    {
        // Given
        $this->expectException(InvalidTypeException::class);
        $this->expectExceptionMessage("1 is not a string");

        // When
        $ints = [1, 2, 3, 4];

        // Then
        new StringCollection($ints);
    }
}