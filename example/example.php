<?php

require_once('../src/events.php');

class A
{
    use EventHandler {
    }

    function invokeFunction()
    {
        echo "Invoking listeners\n";
        $this->invoke("fire");
    }
}

class B
{
    public function listenerFunc($arg)
    {
        echo B::class . " method Invoked. " . "$arg \n";
    }
}

$objA = new A();
$objB = new B();

//subscribing method from object B to object A
$objA->addListener($objB, 'listenerFunc');

//Invoke methods with value
$objA->invoke("Value 1");