<?php

/**
 * The Mediator Design Pattern is used to reduce the direct communication between objects and instead, 
 * have them communicate through a central mediator.
 * This promotes loose coupling between objects and can make your codebase more maintainable.
 */

/**
 * ChatRoom App
 */

// Mediator
class ChatRoom
{
    public static function showMessage(User $user, $message)
    {
        $time = date('Y-m-d H:i:s');
        echo "$time [{$user->getName()}] : $message\n";
    }
}

// Colleague
class User
{
    protected $name;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function sendMessage($message)
    {
        ChatRoom::showMessage($this, $message);
    }
}

// Usage
$john = new User('John');
$jane = new User('Jane');

$john->sendMessage('Hi, Jane!');
$jane->sendMessage('Hello, John!');
