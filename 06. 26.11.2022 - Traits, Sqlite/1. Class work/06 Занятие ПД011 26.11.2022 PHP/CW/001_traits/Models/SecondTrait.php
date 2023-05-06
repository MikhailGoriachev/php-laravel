<?php
namespace Models;

// Трейт с абстрактным методом и со статическим методом
trait SecondTrait
{
    // для демонстрации переопределения свойства в классе
    protected $prop = false;

    // protected $prop;
	private $prop1;
    public static $staticData;

    // конструктор в трейте - не нужен конструктор в классе
    function __construct($prop = 60) {
        $this->prop = $prop;
        echo "<h4>отработал конструктор из трейта SecondTrait</h4>";
    } // __construct

    // абстрактный метод
    abstract function sub($value);

    // Пример статического метода в трейте
    static function foo() {
        self::$staticData = time() % 60;
        return self::$staticData; // текущее время - секунды
    } // foo

    // метод для демонстрации конфликта по именам методов
    function bar() {
        return "SecondTrait::bar(): ".random_int(-100, 100);
    } // bar
} // trait SecondTrait
