<?php

use PHPUnit\Framework\TestCase;
use Vistik\Collections\FloatCollection;
use Vistik\Exception\InvalidTypeException;

class FloatCollectionTest extends TestCase
{

    /**
     * @test
     *
     */
    public function can_add_float_to_collection()
    {
        // Given
        $floats = [1.1, 2.3, 6.6666, 22/7];

        // When
        $collection = new FloatCollection($floats);

        // Then
        $this->assertEquals(4, $collection->count());
        $this->assertEquals($floats, $collection->toArray());
    }

    /**
     * @test
     *
     */
    public function cannot_add_a_non_float_to_collection()
    {
        // Given
        $this->expectException(InvalidTypeException::class);
        $this->expectExceptionMessage("1 is not a valid float");

        // When
        $ints = [1, 2, 3, 4];

        // Then
        new FloatCollection($ints);
    }
}