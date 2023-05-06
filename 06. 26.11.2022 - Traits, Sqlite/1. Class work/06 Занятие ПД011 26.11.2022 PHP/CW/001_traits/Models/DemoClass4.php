<?php
namespace Models;

require_once "FirstTrait.php";
require_once "SecondTrait.php";

// демонстрация решения конфликта именования методов
// в разных трейтах
class DemoClass4
{
    // способ подключения более одного трейта если нет конфликтов в трейтах
    // use FirstTrait, SecondTrait;

    // объявление используемых трейтов с решением конфликта по именам методов трейтов
    use FirstTrait, SecondTrait {
        // insteadof - использовать вместо
        // под именем bar использовать метод из трейта FirstTrait
        FirstTrait::bar insteadof SecondTrait;

        // назначить синоним barSecondTrait методу bar из трейта SecondTrait
        // при назначении синонима можно задать уровень видимости
        SecondTrait::bar as protected barSecondTrait;
    }

    // переопределенное свойство трейта должно совпадать с трейтом
    // до значения инициализации
    protected $prop = false;
    // protected $prop;

    // переопределение конструктора, заданного в трейте
    function __construct($arr = [5, -6, 7], $prop = 23) {
        $this->data = $arr;
        $this->prop = $prop;

		$this->prop1 = 101;
        echo "<h4>отработал конструктор класса ClassDemo4</h4>";
    }

    function __toString() {
        $str = $this->infoToString("DemoClass4: Данные в массиве");
        $str .= "prop = $this->prop<br/>";
		$str .= "$this->prop1<br/>";
        return $str;
    } // __toString

    // реализация абстрактного метода трейта SecondTrait
    function sub($value) {
        return $this->prop - $value;
    } // sub

    // $this->bar(): метод какого трейта вызывается?
    function method1() {
        $temp = $this->bar();  // FirstTrait
        echo "method1: Значение, полученное из метода bar(): $temp<br/>";

        $temp = $this->barSecondTrait(); // SecondTrait
        echo "method1: Значение, полученное из метода barSecondTrait(): $temp<br/>";
    } // method1

    // приоритет переопределений
    // методы трейта переопределяют унаследованные методы базового класса
    // методы класса переопределяют методы трейта
} // class DemoClass4
