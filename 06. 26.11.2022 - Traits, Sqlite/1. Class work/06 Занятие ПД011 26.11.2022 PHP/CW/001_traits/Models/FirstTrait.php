<?php
namespace Models;

// трейт - примесь, добавка
trait FirstTrait
{
    // cвойства трейта
    protected $data = [];
    private $xyz;
	private $prop1;

    // вывод коллекции $data
    function infoToString($title) {
        $str = "<h4>$title</h4><ul>";
        foreach ($this->data as $value) {
        	$str .= "<li>$value</li>";
        } // foreach
        $str .= "<li><b>$this->xyz</b></li></ul>";

        return $str;
    } // infoToString

    // добавление элемента $item в коллекцию только если
    // этот элемент является числом
    function addItem($item) {
        if (!is_numeric($item)) return null;

        $this->data[] = $item;
        return $item;
    } // addItem

    // просто еще один метод для трейта
    function bar() {
        return "FirstTrait::bar(): пример метода, реализованного в трейте";
    } // bar
} // trait FirstTrait
