<?php
namespace Models;

// использованеие трейта FirstTrait
class DemoClass2
{
    // использование трейта
    use FirstTrait;

    // еще одно свойство класса в дополнение к объявленным в трейте
    protected $a;

    function __construct($a, $b = "свойство трейта") {
        // массив заполним значением текущего часа, минуты и секунды
        // (без учета часового пояса)
        $seconds = time();  // время в секундах с начала эпохи

        // запись в свойство трейта
        //             час                   минуты              секунды
        $this->data = [$seconds / 3600 % 24, $seconds / 60 % 60, $seconds % 60];

        // доступ к свойству класса
        $this->a = $a;

        // доступ к еще одному свойству трейта
        $this->xyz = $b;
    } // __construct

    // magic-method с обращением к методу трейта infoToString()
    function __toString() {
        $str = $this->infoToString("Коллекция данных: ");
        $str .= "Свойство a = \"$this->a\"<br/>";
        $str .= "Свойство prop1 = \"$this->prop1\"<br/>";
        return $str;
    } // __toString


    // magic-getter
    function __get($name) {
        return match ($name) {
            "a"     => $this->a,
            "data"  => $this->data,
            "xyz"   => $this->xyz,
            "prop1" => $this->prop1,
            default => null,
        }; // switch
    } // __get
} // class DemoClass2
