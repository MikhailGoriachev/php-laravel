<?php

class MagicDemo {
    // private $n;
    public $prop;   // явно определенное свойство
    public $coffee; // еще одно явно определенное свойство

    // свойства, определенные в ассоциативном массиве - в классе доступ к ним
	// при помощи перегруженных геттера и сеттера (__get(), __set())
	// вне класса - как обычно $имяОбъекта->ИмяСвойстваИзМассива
    // имена свойств: a, b, c, n
    // private $x = array("a" => 1, "b" => 2, "c" => "строка символов", "n" => 0);
    private $hiddenProperties = [
        "a" => 1,
        "b" => 2,
        "c" => "строка символов",
        "n" => 0
    ];

    // перегруженный геттер - получение доступа к свойству,
    // явно не определенному в классе
    // Например, свойства определены в ассоциативном массиве
	// $name - это ключ массива, т.е. имя свойства
	// Доступ к свойству - как к обычному свойству
	// $имяОбъекта->ИмяСвойстваИзМассива
	// например, в нашем случае $s->a, $s->b, $s->c, $s->n (примеры ниже)
    function __get($name) {
        print "Читаем [$name]... ";

        // поиск заданного неявно свойства по имени в ассоциативном массиве
        if (isset($this->hiddenProperties[$name])) {
            $r = $this->hiddenProperties[$name];
            print "Получили: $r<br/>";
            return $r;
        } else {
            print "<span style='color: orangered;'>Всё плохо! Свойства $name нет</span><br/>";
            return null;
        } // if
    } // __get


    // перегруженный cеттер - аналог __get(), но для изменения
	// неявно определенных свойств
    function __set($name, $value) {
        print "Пишем \"$value\" в [$name]... ";

        // поиск заданного неявно свойства по имени в ассоцитивном массиве
        if (isset($this->hiddenProperties[$name])) {
            $this->hiddenProperties[$name] = $value;
            print "Ok<br/>";
        } else {
            print "<span style='color: orangered;'>Всё плохо! Свойства $name нет</span><br/>";
        } // if
    } // __set

    // перегруженный вызов метода - вызов метода, которого нет в классе
	// $name - имя вызываемого метода
	// $args - массив фактических параметров вызова
	function __call($name, $args) {
	    print "<span style='color: orangered;'>Вызван метод $name :</span><br/>";
	    var_dump($args);  // вывод массива параметров
	    return $this->hiddenProperties;
	} // __call

    // обычный метод
    public function method() {
        echo "method() - Ok<br/>";
        $this->coffee = "Американо";
    } // method

	// Метод для формирования строкового представления объекта класса
	function __toString() {
		return "prop = $this->prop; coffee = $this->coffee" // вывод явных свойств
            ."; a = ".$this->__get('a')               // вывод неявных свойств
			."; b = ".$this->hiddenProperties['b']          // так быстрее, конечно
			."; c = ".$this->__get('c')
			."; n = ".$this->hiddenProperties['n'];
	} // __toString
} // class MagicDemo
