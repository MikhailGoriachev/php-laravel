<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8" http-equiv="refresh" />
    <title>ООП в PHP: наследование</title>
    <link rel="stylesheet" href="css/style.css"/>
    <link href="imgs/broom.png" rel="shortcut icon" type="image/x-icon" />	
</head>
<body>
    <h3>Наследование в PHP</h3>
	<?php

    /*
    Основные свойства наследования:
        • единственное наследование (для классов)
        • интерфейсы (с множественным наследованием)
        • абстрактные классы и методы
        • переопределение методов
        • прямое обращение к методам предка через специальное ключевое слово parent
        • конструктор и деструктор предка должны вызываться явно при помощи  parent
        • запрет наследования  final
    */


    // Базовый класс
    class Base {
        public    $a;
        protected $b;  // доступен только производным классам

        // единственный конструктор
        public function __construct($a = 0, $b = 0) {
            $this->a = $a;
            $this->b = $b;

            echo "<span style='color: orangered;'>Конструктор Base: $this->a; $this->b</span><br/>";
        } // __construct

        // единственный деструктор
        public function __destruct() {
            echo "<span style='color: orangered;'>деструктор Base</span><br/>";
        } // __destruct

        public function getB() {return $this->b;}
        public function setB($value) { $this->b = $value; }

        // просто метод класса
        public function foo() {
            $this->b++;
            echo "Base: foo, $this->b<br/>";
        }

        // метод для полиморфного вызова, участвует в полиморйном вызове
        public function zoo() { echo "Base: zoo()<br/>"; }

        // полиморфный вызов метода zoo(), определенного и в Base и в Derive
        // в зависимости от типа объекта вызывается либо Base->zoo() либо Derive->zoo()
        public function methodDemo() { $this->zoo(); }
    } // class Base

    /*
    // Производный класс Derive наследует от класса Base
    // буквально - расширяет класс Base
    class Derive extends Base {
        public $c;   // свойство производного класса

        public function __construct($a = 0, $b = 0, $c = 0) {
            parent::__construct($a, $b);  // !!! явный вызов конструктора базового класса

            $this->c = $c;
            echo "<span style='color: brown;'>Конструктор Derive: $this->c</span><br />";
        } // __construct

        // деструктор
        public function __destruct() {
			// порядок действий очень важен
			// 1. Выполнить работу производного класса
			// 2. Вызвать деструктор базового класса

			// тут должно выполняться закрытие ресурсов производного класса
            echo "<span style='color: brown;'>деструктор Derive</span><br />";

            // !!! явный вызов деструктора базового класса
			parent::__destruct();
        } // __destruct

        // демонстрация переопределения метода
        public function foo() {
            parent::foo();     // вызываем метод foo() предка

            $this->b += 5;
            echo "Derive: foo, $this->b<br/>";
        } // foo

        // метод для демонстрации полиморфного вызова при помощи
        // объекта базового класса
        public function zoo() { echo "Derive: zoo()<br/>"; }
    } // class Derive

    // -------------------------------------------------------------------

    // Применение классов
    echo "<h4>Создание объекта базвого класса</h4>";
    $obj = new Base(1, 2);
    print_r($obj);
    echo "<br/>Объект удаляем: ";
    unset($obj);  // удаление объекта базового класса
    echo "<br/>";

	echo "<h4>Создание объекта производного класса</h4>";
    $obj = new Derive(1, 2, 3);
    print_r($obj);
    echo "<br/>";


    // Вызов метода, который вызывает метод предка ))
    echo 'Метод <b>$obj->foo()</b> вызывает метод предка<br/>';
    $obj->foo();
    echo "<hr/>";


    // Демо полиморфного вызова.
    // methodDemo() полиморфно вызывает zoo(), т.е. вызывается
    // метод принадлежащий объекту
    // объект класса Derive -- метод zoo() класса Derive
    // объект класса Base   -- метод zoo() класса Base

    echo "<h4>Демо полиморфного вызова</h4>";
    echo 'Вызов $obj->methodDemo() из объекта типа Derive:<br>';
    $obj->methodDemo(); // этот метод вызывает zoo() -- т.к. текущий объект - Derive
    echo "<br>";
    unset($obj);


    $base = new Base();
    echo "<br>";
    echo 'Вызов $base->methodDemo() из объекта типа Base:<br>';
    $base->methodDemo();
    echo "<br><hr>";
    */


    // -----------------------------------------------
    // Абстрактный класс
    abstract class AbstractClass {
        protected $a;

        function __construct($a = 1) {
            $this->a = $a;
        } // __construct

        // абстрактный метод
        abstract public function bar();

        // обычный метод
        public function show() { echo "show() из AbstractClass<br>"; }
    } // abstract class

    // конкретная реализация абстрактного класса
    class ConcreteClass extends AbstractClass {
        protected $b;

        function __construct($a = 1, $b = 2) {
            // вызов конструктора базового класса
            // то, что базовый класс абстрактный  не имеет значения
            parent::__construct($a);

            $this->b = $b;
        } // __construct


        // в производном классе свойство $a представляет, например, радиус
        // поэтому геттер реализуем в производном классе
        function getRadius() { return $this->a; }
        function getB()      { return $this->b; }

        // реализация абстрактного метода класса AbstractClass
        function bar() { echo "Реализация bar() в ConcreteClass<br>"; }

        // обычный метод класса ConcreteClass
        function foo() { echo "foo() из ConcreteClass<br>"; }
    } // class ConcreteClass

    echo "<h3>Использование абстрактного класса</h3>";

    // Создание экземпляра и обращение к методам
    $concrete = new ConcreteClass();
    $concrete->foo();      // определен в ConcreteClass
    $concrete->show();     // унаследован из AbstractClass

    echo "<br/>Получить радиус: ".$concrete->getRadius()
        .", получить свойство b: ".$concrete->getB()
        ."<br><hr>";


    // создание и использование интерфейсов
    echo "<h3>Интерфейсы в PHP</h3>";
    interface IExample1 {
        function add($a);
        function sub($a);
    } // interface IExample1

    interface IExample2 {
        public function mul($a);
        public function div($a);
        public function mod($a);
    } // interface IExample2

    // класс, реализующий интерфейс
    class Example1 extends Base implements IExample1 {

        // конструктор
        public function __construct($a = 0, $b = 0) {
            parent::__construct($a, $b);
        } // __construct

        // деструктор
        public function __destruct() {
            parent::__destruct();
        } // __destruct

        // реализация интерфейса
        public function add($a) { $this->a += $a; $this->b += $a; }
        public function sub($a) { $this->a -= $a; $this->b -= $a; }
    } // class Example1


    // класс, реализующий более одного интерфейса
    class Example2 extends Base implements IExample1, IExample2 {
        // конструктор
        public function __construct($a = 0, $b = 1) {
            parent::__construct($a, $b);
        } // __construct

        // деструктор
        public function __destruct() {
            parent::__destruct();
        } // __destruct

        // реализация интерфейса IExample1
        public function add($a) { $this->a += $a; $this->b += $a; }
        public function sub($a) { $this->a -= $a; $this->b -= $a; }

        // реализация интерфейса IExample2
        public function mul($a) { $this->a *= $a; $this->b *= $a; }
        public function div($a) { $this->a /= $a; $this->b /= $a; }
        public function mod($a) { $this->a %= $a; $this->b %= $a; }
    } // class Example2

    // интерфейс с методом, уже реализованным в базовом классе
    interface IBase {
        function foo();            // есть в  базовом классе
        function bar($a1, $a2);    // нет в базовом классе
    } // interface IBase

    // расширение класса, реализация интерфейса, возможно множественное наследование интерфейсов
    class Derive2 extends Base implements IBase {
        // метод foo() можно не реализовывать, он уже есть в базовом классе

        function bar($a1, $a2) {
            echo "<ul></ul><li>a1 = $a1</li><li>a2 = $a2</li></ul>";
            $a = $a1;
            $b = $a2;
        } // bar
    } // class Derive2

    /*
    // Удаление объекта
    // unset($obj);

    echo "<h4>Объект с интерфейсом IExample1:</h4>";
    $obj = new Example1();
    echo "<br/>";
    print_r($obj);
    echo "<br/>";

    echo "Вызов методов интерфейса  IExample1:<br/>";
    $obj->add(10);
    $obj->sub(3);
    print_r($obj);
    echo "<br/>";

    // Удаление объекта
    unset($obj);
    echo "<h4>Объект с интерфейсами IExample1, IExample2:</h4>";
    $obj = new Example2();
    echo "<br/>";
    print_r($obj);
    echo "<br/>";

    echo "Вызов методов интерфейса  IExample1:<br/>";
    $obj->add(10);
    $obj->sub(3);
    print_r($obj);
    echo "<br/>";

    echo "Вызов методов интерфейса  IExample2:<br/>";
    $obj->mul(10);
    $obj->div(3);
    $obj->mod(3);
    print_r($obj);
    echo "<br/><hr/>";

    echo "Вызов методов интерфейса  IBase:<br/>";
    $derive2 = new Derive2(-1, -2);
    $derive2->foo();
    $derive2->bar(1, 2);
    print_r($derive2);
    echo "<br><hr>";
    */


    echo "<h3>Запрет наследования класса  или переопределения метода - final</h3>";
    // Запрет наследования - final
    final class Sealed { }

    // наследование от final-класса невозможном
    // class ClassC extends Sealed {}

	// final-методы
    class A {
        // переопределять этот метод можно
        public function foo() { echo "A: foo()<br/>"; }

        // переопределять final метод нельзя
        final public function bar() { echo "A: final bar()<br/>"; }
    } // class A

    class B extends A {
        // переопределение метода - все ок
        public function foo() { echo "B: bar()<br/>"; }

        // переопределение final-метода приводит к неработоспособности страницы !!!
        // public function bar() { echo "B: bar()<br/>"; }
    } // class B


    // объект для исследования
    $b = new B();
    $b->foo();
    $b->bar();

    echo '<br/><hr/>';


    // оператотр instanceof - принадлежность к типу
    // выражение instanceof Тип
    echo '<h3>Оператор instanceof - принадлежность к типу</h3>';

    echo 'Объект $b класс B, производный от класса A:<br/>';
    echo 'Объект $b принадлежит типу/классу B: '.(($b instanceof B)?'да':'нет').'<br/>';
    echo 'Объект $b принадлежит типу/классу A: '.(($b instanceof A)?'да':'нет').'<br/>';
    echo 'Объект $b принадлежит типу/классу Example1: '.(($b instanceof Example1)?'да':'нет').'<br/>';
    echo '<br/>';

    $example1 = new Example1();
    echo 'Объект $example1 принадлежит типу/классу IExample1: '.(($example1 instanceof IExample1)?'да':'нет').'<br/>';
    echo 'Объект $example1 принадлежит типу/классу Example1: '.(($example1 instanceof Example1)?'да':'нет').'<br/>';
    echo '<br/>';

    $example2 = new Example2();
    echo 'Объект $example2 класс Example2, производный от класса Base, IExample1, IExample2:<br/>';
    echo 'Объект $example2 принадлежит типу/классу Base: '.(($example2 instanceof Base)?'да':'нет').'<br/>';
    echo 'Объект $example2 принадлежит типу/классу IExample1: '.(($example2 instanceof IExample1)?'да':'нет').'<br/>';
    echo 'Объект $example2 принадлежит типу/классу IExample2: '.(($example2 instanceof IExample2)?'да':'нет').'<br/>';
    echo 'Объект $example2 принадлежит типу/классу Example1: '.(($example2 instanceof Example1)?'да':'нет').'<br/>';
    echo '<hr/>';

    echo '<h3>Сравнение объектов == != === !==</h3>';

    // сравнение объектов == != === !==
    // == / !=  принадлежат/не принадлежат одному типу, все поля совпадают
    // === / !== указывают/не указывают на один и тот же объект
    $c = new B();

    echo '<span class="green-text">Два объекта одного типа ($c, $b) ';
    if ($b == $c)
        echo 'равны по ==';
    else
        echo '<b>не</b> равны по ==';
    echo "</span><br><br>";

    echo "<span class='green-text'>Два объекта одного типа ";
    if ($b === $c):
        echo "равны по ===";
    else:
        echo "<b>не</b> равны по ===<br/>";
	endif;
    echo "</span><br><br>";

    // Теперь переменные указывают на один и тот же объект
    echo "<span class='green-text'>Две переменные, указывающие на один объект ";
    $c = $b;
    if ($b == $c):
        echo "равны по ==";
    else:
        echo "<b>не</b> равны по ==";
	endif;
    echo "</span><br><br>";

    echo "<span class='green-text'>Две переменные, указывающие на один объект ";
    if ($b === $c):
        echo "равны по ===";
    else:
        echo "не равны по ===";
	endif;

    echo "</span><br><br><br>";

	?>
</body>
</html>
