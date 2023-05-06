<?php

// Модель для сериализации
class A
{
    // просто набор свойств
    public $prop1;
    public $prop2;

    /**
     * A constructor.
     * @param $prop1
     * @param $prop2
     */
    public function __construct($prop1, $prop2) {
        $this->prop1 = $prop1;
        $this->prop2 = $prop2;
    }

    // формирование строкового представления объекта
    public function __toString() {
        return "{$this->prop1}; {$this->prop2}";
    } // toString

    // участвует в сериализации
    public function __sleep() {
        echo "__sleep<br/>";
        return ["prop1", "prop2"];
    } // __sleep

    // участвует в десериализации
    public function __wakeup() {
        echo "__wakeup<br/>";
    } // __wakeup
} // class A