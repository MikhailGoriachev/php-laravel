<?php
namespace Models;

class A
{
    public $prop1;
    public $prop2;

    /**
     * A constructor.
     * @param $prop1
     * @param $prop2
     */
    public function __construct($prop1, $prop2)
    {
        $this->prop1 = $prop1;
        $this->prop2 = $prop2;
    }

    public function __toString()
    {
        return "{$this->prop1}; {$this->prop2}";

    }

    // участвует в сериализации
    public function __sleep()
    {
        echo "__sleep<br/>";
        return ["prop1", "prop2"];
    }

    // участвует в десериализации
    public function __wakeup()
    {
        echo "__wakeup<br/>";
    }


}