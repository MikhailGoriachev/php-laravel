<?php

namespace Models\Task01;

use Models\ITable;

// Клиент
class Client implements ITable {

    public int $id;
    
    // фамилия
    public string $last_name;
    
    // имя
    public string $first_name;
    
    // отчество
    public string $patronymic;
    
    // пасспорт
    public string $passport;


    // заголовок таблицы
    static public function headerTable(): string {
        return '
            <tr>
                <th>ID</th>
                <th>Фамилия</th>
                <th>Имя</th>
                <th>Отчество</th>
                <th>Паспорт</th>
            </tr>
        ';
    }

    // строка таблицы
    public function toTableRow(): string {
        return "
            <tr>
                <td>$this->id</td>
                <td>$this->last_name</td>
                <td>$this->first_name</td>
                <td>$this->patronymic</td>
                <td>$this->passport</td>
            </tr>
        ";
    }
}