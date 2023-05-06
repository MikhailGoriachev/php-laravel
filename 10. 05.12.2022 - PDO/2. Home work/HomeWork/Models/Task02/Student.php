<?php

namespace Models\Task02;

use Models\ITable;

// Студент
class Student implements ITable {

    public int $id;
    
    // фамилия
    public string $last_name;
    
    // имя
    public string $first_name;
    
    // отчество
    public string $patronymic;
    
    // адрес
    public string $address;
    
    // год рождения
    public string $year_of_birth;
    
    // паспорт
    public string $passport;
    
    // заголовок таблицы
    static public function headerTable(): string {
        return '
            <tr>
                <th>ID</th>
                <th>Фамилия</th>
                <th>Имя</th>
                <th>Отчество</th>
                <th>Адрес</th>
                <th>Год рождения</th>
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
                <td>$this->address</td>
                <td>$this->year_of_birth</td>
                <td>$this->passport</td> 
            </tr>
        ";
    }
}