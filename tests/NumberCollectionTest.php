<?php


use Illuminate\Support\Str;
use PHPUnit\Framework\TestCase;
use PhpSafari\Collections\NumberCollection;
use PhpSafari\Exception\InvalidTypeException;
use PhpSafari\Collections\IntCollection;

class NumberCollectionTest extends TestCase
{

    /**
     * @test
     *
     */
    public function can_add_any_number_to_collection()
    {
        // Given
        $numbers = [1, 2.55, 3.14, 6 + 7, INF];

        // When
        $collection = new NumberCollection($numbers);

        // Then
        $this->assertEquals(5, $collection->count());
        $this->assertEquals($numbers, $collection->toArray());
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
        $this->expectExceptionMessage("$random is not a number");

        // When
        $strings = [$random];

        // Then
        new NumberCollection($strings);
    }

    /**
     * @test
     */
    public function can_create_via_helper()
    {
        // Given

        // When
        $collection = nCollect([1, 2.55, 3.14, 6 + 7]);

        // Then
        $this->assertEquals(4, $collection->count());
        $this->assertEquals([1, 2.55, 3.14, 6 + 7], $collection->toArray());
    }

    /**
     * @test
     */
    public function can_use_collection_method()
    {
        // Given
        $collection = nCollect([1, 2.55, 3.14, 6 + 7]);

        // When
        $collection = $collection->reject(function($item){
            return $item > 2;
        });

        // Then
        $this->assertEquals(1, $collection->count());
        $this->assertEquals([1], $collection->toArray());
        $this->assertInstanceOf(NumberCollection::class, $collection);
    }
}