<?php

class MagicDemo {
    private $prop;      // явно определенное свойство
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

    // Magic-метод для реализации клонирования
    function __clone() {
        echo "__clone: Тут выполняем действия по клонированию объекта<br>";
    } // __clone


    //region Аксессоры для свойств
    public function getProp() { return $this->prop; }
    public function setProp($prop) {
        $this->prop = $prop;
    }


    public function getBeveridge() { return $this->beveridge; }
    public function setBeveridge($beveridge) {
        $this->beveridge = $beveridge;
    }
    //endregion

    // строковое представление объекта
    public function __toString() {
        return "prop: '{$this->prop}'; beveridge: '{$this->beveridge}'";
    } // toString


} // class MagicDemo
