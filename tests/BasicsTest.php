<?php

use Vistik\Example\User;
use Vistik\Lists\UserList;


class Basics extends TestCase
{

    /**
     * @test
     */
    public function can_add_to_type_list()
    {
        $list = new UserList();

        $user = new User('name', 'email@example.com');
        $list[] = $user;

        $this->assertEquals($list[0], $user);

    }

    /**
     * @test
     */
    public function can_add_to_type_list_with_a_key()
    {
        $list = new UserList();

        $user = new User('name', 'email@example.com');
        $list['key'] = $user;

        $this->assertEquals($list['key'], $user);

    }

    /**
     * @test
     */
    public function cannot_add_a_non_user_to_list()
    {
        $list = new UserList();

        $this->setExpectedException('Vistik\Exception\InvalidTypeException', "Item (string) 'not a user' is not a Vistik\\Example\\User object!");
        $list[] = 'not a user';
    }

    /**
     * @test
     */
    public function can_loop_over_a_list_with_foreach()
    {

        $user1 = new User('name1', 'email1@example.com');
        $user2 = new User('name2', 'email2@example.com');
        $user3 = new User('name3', 'email3@example.com');
        $user4 = new User('name4', 'email4@example.com');

        $list = new UserList($user1, $user2, $user3, $user4);

        foreach ($list as $item) {
            $this->assertTrue($item instanceof User);
        }
    }

    /**
     * @test
     */
    public function can_loop_over_a_list_with_for()
    {
        $users = [];
        $users[] = new User('name1', 'email1@example.com');
        $users[] = new User('name2', 'email2@example.com');
        $users[] = new User('name3', 'email3@example.com');
        $users[] = new User('name4', 'email4@example.com');

        $list = new UserList($users[0], $users[1], $users[2], $users[3]);

        $this->assertEquals(4, count($list));

        for ($i = 0; $i < count($list); $i ++) {
            $this->assertEquals($list[$i], $users[$i]);
        }
    }

    /**
     * @test
     */
    public function can_use_collection_methods()
    {
        $users = [];
        $users[] = new User('name1', 'email1@example.com');
        $users[] = new User('name2', 'email2@example.com');
        $users[] = new User('name3', 'email3@example.com');
        $users[] = new User('name4', 'email4@example.com');

        $list = new UserList($users[0], $users[1], $users[2], $users[3]);

        $this->assertEquals(4, $list->count());
        $this->assertEquals($list[0], $list->first());
        $this->assertEquals($list[3], $list->last());

        $this->assertEquals($users, $list->all());

        $list->forget(0);
        unset($users[0]);

        $this->assertEquals($users, $list->all());

        $list->count(3, $list->count());
//        $this->assertFalse($list->contains(0));
//        $this->assertTrue($list->contains(1));

    }

    /**
    * @test
    */
    public function can_add_to_collection_via_add_method()
    {
        $user1 = new User('name1', 'email1@example.com');
        $user2 = new User('name2', 'email2@example.com');

        $list = new UserList();
        $list->add($user1);
        $list->add($user2);

        $this->assertEquals($user1, $list->first());
        $this->assertEquals($user2, $list->last());

    }

}
