<?php

namespace Models\Task02;

use Models\ITable;

// Учебный предмет
class AcademicSubject implements ITable {

    public int $id;
    
    // название
    public string $name;


    // заголовок таблицы
    static public function headerTable(): string {
        return '
            <tr>
                <th>ID</th>
                <th>Название</th>
            </tr>
        ';
    }

    // строка таблицы
    public function toTableRow(): string {
        return "
            <tr>
                <td>$this->id</td>
                <td>$this->name</td>
            </tr>
        ";
    }
}