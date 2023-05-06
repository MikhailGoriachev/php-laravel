<?php

// Свой класс для описания исключения
class MyClassException extends Exception {
    public function __construct($message = "Какие-то проблемы") {
        // получить имя файла исходного текста в кодировке UTF-8
        $fileName = $this->getFile();

        // $this->getLine() - строка, в которой возникла ошибка
        $line = $this->getLine();
        
        $this->message = "$message. $line-я строка,<br>файл: $fileName";
    } // __construct
} // class MyClassException
