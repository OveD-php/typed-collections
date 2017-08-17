<?php

namespace Phpsafari\Example;

class User
{

    private $name;
    private $email;

    public function __construct($name, $email)
    {

        $this->name = $name;
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }
}
