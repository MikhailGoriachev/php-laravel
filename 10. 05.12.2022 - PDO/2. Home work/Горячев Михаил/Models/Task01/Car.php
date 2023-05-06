<?php

namespace Models\Task01;

use Models\ITable;

// Автомобиль
class Car implements ITable {

    public int $id;
    
    // модель
    public string $brand_name;
    
    // цвет
    public string $color_name;
    
    // номер
    public string $plate;
    
    // год выпуска
    public int $year_manufacture;
    
    // страховая стоимость
    public int $inshurance_pay;
    
    // плата
    public int $rental;


    // заголовок таблицы
    static public function headerTable(): string {
        return '
            <tr>
                <th>ID</th>
                <th>Модель</th>
                <th>Номер</th>
                <th>Год выпуска</th>
                <th>Цвет</th>
                <th>Страх. стоимость</th>
                <th>Аренда</th>
            </tr>
        ';
    }

    // строка таблицы
    public function toTableRow(): string {
        return "
            <tr>
                <td>$this->id</td>
                <td>$this->brand_name</td>
                <td>$this->plate</td>
                <td>$this->year_manufacture</td>
                <td>$this->color_name</td>
                <td>$this->inshurance_pay</td>
                <td>$this->rental</td>
            </tr>
        ";
    }
}