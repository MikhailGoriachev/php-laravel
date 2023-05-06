<?php

namespace Models\Task01;

use Models\ITable;

// Аренда
class Rental implements ITable {

    public int $id;

    // фамилия клиента
    public string $last_name;

    // имя клиента
    public string $first_name;

    // отчество клиента
    public string $patronymic;

    // паспорт
    public string $passport;

    // модель
    public string $brand_name;

    // цвет
    public string $color_name;

    // номер автомобиля
    public string $plate;

    // страховая стоимость
    public int $inshurance_pay;

    // плата
    public int $rental;

    // дата начала
    public string $date_start;

    // количество
    public int $duration;


    // заголовок таблицы
    static public function headerTable(): string {
        return '
            <tr>
                <th>ID</th>
                <th>Клиент</th>
                <th>Паспорт</th>
                <th>Модель</th>
                <th>Цвет</th>
                <th>Номер</th>
                <th>Страх. стоимость</th>
                <th>Аренда</th>
                <th>Дата</th>
                <th>Длительность</th>
                <th class="text-center">
                    <form class="d-inline" action="/pages/task01/tables/rentals.php" method="post">
                        <button type="submit" class="btn btn-success" name="add" title="Добавить">
                            <i class="bi bi-plus-lg"></i>Добавить...
                        </button>
                    </form>    
                </th>
            </tr>
        ';
    }

    // строка таблицы
    public function toTableRow(): string {
        $client = $this->last_name . ' ' . mb_substr($this->first_name, 0, 1) . '.' . mb_substr($this->patronymic, 0, 1) . '.';
        return "
            <tr>
                <td>$this->id</td>
                <td>$client</td>
                <td>$this->passport</td>
                <td>$this->brand_name</td>
                <td>$this->color_name</td>
                <td>$this->plate</td>
                <td>$this->inshurance_pay</td>
                <td>$this->rental</td>
                <td>$this->date_start</td>
                <td>$this->duration</td>
                <td class='text-center'>
                    <form class='d-inline' action='/pages/task01/tables/rentals.php' method='post'>
                        <button type='submit' class='btn btn-warning' name='edit' value='$this->id' title='Изменить'>
                            <i class='bi bi-pencil-fill'></i>
                        </button>                        
                    </form>    
                </td>
            </tr>
        ";
    }
}