[![Build Status](https://travis-ci.org/vistik/type-hinted-arrays.svg?branch=master)](https://travis-ci.org/vistik/type-hinted-arrays) [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/vistik/type-hinted-arrays/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/vistik/type-hinted-arrays/?branch=master)

### What is this?

This is a very simple way to make arrays type hinted!

```$list = new UserList(new User());```

OK

`$list = new UserList('User');`

Will throw:

`Vistik\Exception\InvalidTypeException: Item (string) 'User' is not a Vistik\Example\User object!`

### Install
Run `composer require vistik/type-hinted-arrays`

### Do I have to create a type for each list? Yes, but
Look how easy it is:

    class UserList extends TypeList{
        protected $type = 'Vistik\Example\User';
    }

2 simple steps

1) Create a Class eg. `AccountList` extend `TypeList`  
2) Just replace `protected $type = 'Vistik\Example\User';` with your class

### Features

* Build opon [Illuminate\Support\Collection](https://github.com/illuminate/support)
* Very simple to implement custom Lists
