<?php

use Illuminate\Support\Collection;
use PHPUnit\Framework\TestCase;
use Phpsafari\Example\User;
use Phpsafari\Exception\InvalidTypeException;
use Phpsafari\Collections\UserCollection;

class Basics extends TestCase
{

    /**
     * @test
     */
    public function can_add_to_type_list()
    {
        $list = new UserCollection();

        $user = new User('name', 'email@example.com');
        $list[] = $user;

        $this->assertEquals($list[0], $user);

    }

    /**
     * @test
     */
    public function can_add_to_type_list_with_a_key()
    {
        $list = new UserCollection();

        $user = new User('name', 'email@example.com');
        $list['key'] = $user;

        $this->assertEquals($list['key'], $user);

    }

    /**
     * @test
     */
    public function cannot_add_a_non_user_to_list()
    {
        $list = new UserCollection();

        $this->expectException(InvalidTypeException::class);
        $this->expectExceptionMessage("Item (string) 'not a user' is not a Phpsafari\\Example\\User object!");
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

        $list = new UserCollection([$user1, $user2, $user3, $user4]);

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

        $list = new UserCollection([$users[0], $users[1], $users[2], $users[3]]);

        $this->assertEquals(4, count($list));

        for ($i = 0; $i < count($list); $i++) {
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

        $list = new UserCollection($users);

        $this->assertEquals(4, $list->count());
        $this->assertEquals($list[0], $list->first());
        $this->assertEquals($list[3], $list->last());

        $this->assertEquals($users, $list->all());

        $list->forget(0);
        unset($users[0]);

        $this->assertEquals($users, $list->all());

        $list->count(3, $list->count());
    }

    /**
     * @test
     * @group visti
     */
    public function can_add_an_array()
    {
        $users = [];
        $users[] = new User('name1', 'email1@example.com');
        $users[] = new User('name2', 'email2@example.com');
        $users[] = new User('name3', 'email3@example.com');
        $users[] = new User('name4', 'email4@example.com');

        $list = new UserCollection($users);

        $this->assertEquals($users, $list->all());
        $this->assertEquals(4, $list->count());
    }

    /**
     * @test
     */
    public function can_add_a_collection()
    {
        /** @var Collection $users */
        $users = new Collection();

        $users[] = new User('name1', 'email1@example.com');
        $users[] = new User('name2', 'email2@example.com');
        $users[] = new User('name3', 'email3@example.com');
        $users[] = new User('name4', 'email4@example.com');

        $list = new UserCollection($users);

        $this->assertEquals(4, $list->count());
        $this->assertEquals($users->toArray(), $list->all());
    }

    /**
     * @test
     *
     */
    public function can_convert_to_plain_collection()
    {
        // Given
        /** @var Collection $users */
        $users = new Collection();

        $users[] = new User('name1', 'email1@example.com');
        $users[] = new User('name2', 'email2@example.com');
        $users[] = new User('name3', 'email3@example.com');
        $users[] = new User('name4', 'email4@example.com');

        // When
        $list = new UserCollection($users);
        $collection = $list->toCollection();

        // Then
        $this->assertEquals(4, $collection->count());
        $this->assertTrue($collection instanceof Collection);
        $this->assertFalse($collection instanceof UserCollection);
        $this->assertEquals($collection->toArray(), $list->all());
    }

    /**
     * @test
     *
     */
    public function can_reduce_collection()
    {
        // Given
        $collection = nCollect([1, 2, 3, 4, 5]);

        // When
        $processed = $collection->toCollection()->map(function ($item) {
            return 'visti-' . $item;
        });

        // Then
        $this->assertEquals(['visti-1', 'visti-2', 'visti-3', 'visti-4', 'visti-5'], $processed->toArray());
    }

}
