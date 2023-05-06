<?php

class MagicDemo {
    private $prop;   // явно определенное свойство
    private $beveridge; // еще одно явно определенное свойство

    public function __construct($prop, $coffee) {
        $this->prop = $prop;
        $this->beveridge = $coffee;
    }

    // обычный метод
    public function method() {
        echo "method() - Ok<br/>";
        $this->beveridge = "Американо";
    } // method

    // Метод для реализации клонирования
    function __clone() {
        echo "__clone: выполняем действия по клонированию объекта<br/>";
    }

    public function getProp() { return $this->prop; }

    public function setProp($prop): void {
        $this->prop = $prop;
    }


    public function getBeveridge() {  return $this->beveridge;  }
    public function setBeveridge($beveridge): void {
        $this->beveridge = $beveridge;
    } // setBeveridge


    public function __toString() {
        return "prop: '{$this->prop}'; coffee: '{$this->beveridge}'";
    }

} // class MagicDemo
