<?php

namespace Models\Task02;

// Экзаменатор
use Models\ITable;

class Examiner implements ITable {

    public int $id;
    
    // фамилия
    public string $last_name;
    
    // имя
    public string $first_name;
    
    // отчество
    public string $patronymic;
    
    // стоимость экзамена
    public int $exam_fee;
    

    // заголовок таблицы
    static public function headerTable(): string {
        return '
            <tr>
                <th>ID</th>
                <th>Фамилия</th>
                <th>Имя</th>
                <th>Отчество</th>
                <th>Стоимость экзамена</th>
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
                <td>$this->exam_fee</td>
            </tr>
        ";
    }
}