<?php


use Vistik\Lists\EmailArray;

class EmailListTest extends PHPUnit_Framework_TestCase
{

    /**
     * @test
     */
    public function can_add_email_to_list()
    {
        $email = 'email@example.com';
        $el = new EmailArray('email@example.com');

        $this->assertEquals($email, $el->first());
    }

    /**
     * @test
     */
    public function cannot_add_invalid_email_to_list()
    {
        $this->setExpectedException('Vistik\Exception\InvalidTypeException', 'invalidEmail is not a valid email address');
        $el = new EmailArray('invalidEmail');
    }

    /**
     * @test
     */
    public function can_add_multiple_at_once()
    {
        $el = new EmailArray('email@example.com', 'another@example.com');

        $this->assertEquals('email@example.com', $el->first());
        $this->assertEquals('another@example.com', $el->last());
    }

}