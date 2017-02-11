<?php

use PHPUnit\Framework\TestCase;
use Vistik\Exception\InvalidTypeException;
use Vistik\Collections\EmailCollection;

class EmailCollectionTest extends TestCase
{

    /**
     * @test
     */
    public function can_add_email_to_list()
    {
        $email = 'email@example.com';
        $el = new EmailCollection('email@example.com');

        $this->assertEquals($email, $el->first());
    }

    /**
     * @test
     */
    public function cannot_add_invalid_email_to_list()
    {
        $this->expectException(InvalidTypeException::class);
        $this->expectExceptionMessage('invalidEmail is not a valid email address');
        $el = new EmailCollection('invalidEmail');
    }

    /**
     * @test
     */
    public function can_add_multiple_at_once()
    {
        $el = new EmailCollection(['email@example.com', 'another@example.com']);

        $this->assertEquals('email@example.com', $el->first());
        $this->assertEquals('another@example.com', $el->last());
    }

    /**
     * @test
     */
    public function can_create_object_via_helper()
    {
        // Given
        // When
        $el = eCollect(['email@example.com', 'another@example.com']);

        // Then
        $this->assertEquals('email@example.com', $el->first());
        $this->assertEquals('another@example.com', $el->last());

    }

}