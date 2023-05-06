<?php

namespace Models\Task02;

use Models\ITable;

// Тип экзамена
class ExamType implements ITable {
    
    public int $id;
    
    // название учебного предмета
    public string $academic_subject_name;
    
    // название экзамена
    public string $name;
    
    
    // заголовок таблицы
    static public function headerTable(): string {
        return '
            <tr>
                <th>ID</th>
                <th>Предмет</th>
                <th>Название</th>
            </tr>
        ';
    }

    // строка таблицы
    public function toTableRow(): string {
        return "
            <tr>
                <td>$this->id</td>
                <td>$this->academic_subject_name</td>
                <td>$this->name</td>
            </tr>
        ";
    }
}