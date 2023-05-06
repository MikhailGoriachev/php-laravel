<?php
namespace Models;

// Свой класс для описания исключения
class MyClassException extends Exception {
    public function __construct($message = "Какие-то проблемы") {
        parent::__construct($message);
        
        $this->message = "$message. $this->line-я строка,<br/>файл: $this->file";
    } // __construct
} // class MyClassException