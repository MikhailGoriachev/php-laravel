<?php

namespace Models;

// Поведение для вывода в таблицу
interface ITable {

    // заголовок таблицы
    static public function headerTable(): string;
    
    // вывод в строку таблицу
    public function toTableRow(): string;
}