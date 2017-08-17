<?php


use Illuminate\Support\Str;
use PHPUnit\Framework\TestCase;
use Phpsafari\Exception\InvalidTypeException;
use Phpsafari\Collections\IntCollection;

class IntCollectionTest extends TestCase
{

    /**
     * @test
     *
     */
    public function can_add_string_to_collection()
    {
        // Given
        $ints = [1, 2, 3, 4];

        // When
        $collection = new IntCollection($ints);

        // Then
        $this->assertEquals(4, $collection->count());
        $this->assertEquals($ints, $collection->toArray());
    }

    /**
     * @test
     *
     */
    public function cannot_add_a_string_to_collection()
    {
        // Given
        $random = Str::random();
        $this->expectException(InvalidTypeException::class);
        $this->expectExceptionMessage("$random is not a valid int");

        // When
        $strings = [$random];

        // Then
        new IntCollection($strings);
    }

    /**
     * @test
     */
    public function can_create_via_helper()
    {
        // Given

        // When
        $collection = iCollect([1,4,6]);

        // Then
        $this->assertEquals(3, $collection->count());
        $this->assertEquals([1,4,6], $collection->toArray());
    }
}