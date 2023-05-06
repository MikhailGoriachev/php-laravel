<?php
namespace Models;

require_once "SecondTrait.php";

// Использование трейта с абстрактными методами, статическими
// свойствами и методами, конструктором
class DemoClass3
{
	// задать использование трейта с конструктором и абстрактным методом SecondTrait
    use SecondTrait;

    // реализация абстрактного метода трейта
    function sub($value) {
        return $this->prop - $value;
    } // sub

    // magic-метод для строкового представления класса
    function __toString() {
        return "это объект класса DemoClass3, prop = $this->prop";
    } // __toString
}
