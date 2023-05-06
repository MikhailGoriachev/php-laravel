<?php

namespace App;

use Infrastructure\Utils;
use Models\Goods;

// Задача 1. Создать класс Goods (товар). В классе должны быть представлены поля: наименование товара, дата оформления
// (прихода), цена единицы товара, количество единиц товара, номер накладной, по которой товар поступил на склад.
// 
// Реализовать методы изменения цены единицы товара, изменения количества товара (увеличения и уменьшения), вычисления
// стоимости товара. Разработать форму добавления/редактирования товара. Использовать __toString().
//
// Реализовать массив товаров, добавление в массив, удаление из массива. Данные по товарам сохранять в файле в формате
// CSV. Также требуется выводить таблицу товаров, итоговую сумму хранимых товаров.

// обработка по заданию 1
class Task01 {

    // товары
    public array $goodsList;

    // название файла для сохранения
    public const FILE_NAME = 'goodsList .csv';

    // название папки для сохранения
    public const DIR_NAME = '../../App_Data';


    // конструктор
    public function __construct() {

        // получение данных из файла
        $data = $this->load();

        if (!$data) {
            $data = [
                new Goods(1, 'Apple MacBook Pro 16" M1 Pro', new \DateTime('2022-09-13'), 250_000, random_int(1, 5), random_int(1e10, 1e11)),
                new Goods(2, 'Apple MacBook Pro 16" M1 Max', new \DateTime('2022-10-16'), 220_000, random_int(1, 5), random_int(1e10, 1e11)),
                new Goods(3, 'Apple AirPods with Charging Case', new \DateTime('2022-11-12'), 10_000, random_int(1, 5), random_int(1e10, 1e11)),
                new Goods(4, 'Apple AirPods Max Silver', new \DateTime('2022-11-04'), 26_999, random_int(1, 5), random_int(1e10, 1e11)),
                new Goods(5, 'Apple iPhone 11 128GB', new \DateTime('2022-11-03'), 25_499, random_int(1, 5), random_int(1e10, 1e11)),
                new Goods(6, 'Apple iPhone 13 Pro Max', new \DateTime('2022-10-19'), 62_139, random_int(1, 5), random_int(1e10, 1e11)),
                new Goods(7, 'Apple Watch SE GPS 40mm', new \DateTime('2022-10-01'), 10_000, random_int(1, 5), random_int(1e10, 1e11)),
                new Goods(8, 'Apple Watch Ultra GPS', new \DateTime('2022-10-07'), 85_000, random_int(1, 5), random_int(1e10, 1e11)),
                new Goods(9, 'Apple iMac 24" М1 4.5К', new \DateTime('2022-09-19'), 180_000, random_int(1, 5), random_int(1e10, 1e11)),
                new Goods(10, 'Apple Mac mini М1', new \DateTime('2022-11-11'), 89_000, random_int(1, 5), random_int(1e10, 1e11)),
            ];

            $this->save($data);
        }

        $this->goodsList = $data;
    }

    // вывод данных в таблицу
    public function toTable(): string {
        $rows = array_reduce($this->goodsList, fn($p, $c) => $p . $c->toTableRow(), '');

        return <<<EOF
            <table class="table">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Наименование</th>
                    <th>Дата оформления</th>
                    <th>Накладная</th>
                    <th>Цена ед. (&#8381;)</th>
                    <th>Количество</th>
                    <th>Стоимость товара</th>
                    <th class="text-center">
                        <form action='/pages/task01/goodsForm.php' method="post">
                            <button class='btn btn-outline-success' type='submit' name='add' title='Добавить...'>
                                <i class="bi bi-plus-lg"></i> Добавить
                            </button>
                        </form>
                    </th>
                </tr>
                </thead>
                
                <tbody>
                    $rows
                </tbody>
            </table>
        EOF;
    }

    // получить суммарную стоимость
    public function getSumCost(): float {
        return array_reduce($this->goodsList, fn($p, $c) => $p + $c->getCost(), 0);
    }

    // удалить элемент
    public function removeItem(int|null $id): void {
        if ($id === null)
            return;

        unset($this->goodsList[key(array_filter($this->goodsList, fn($g) => $g->getId() === $id))]);

        $this->goodsList = array_values($this->goodsList);

        $this->save($this->goodsList);
    }

    // сохранить данные
    public function save(array $data): void {
        Utils::saveToCsv(self::DIR_NAME, self::FILE_NAME, array_map(fn($d) => $d->getArrayToScv(), $data));
    }

    // загрузить даннные
    public function load(): array|null {
        $data = Utils::loadFromCsv(self::DIR_NAME . '/' . self::FILE_NAME);

        if (!$data)
            return null;

        return array_map(fn($d) => Goods::setDataFromArrayScv($d), $data);
    }

    // обработка формы
    function formHandle(): void {
        $isAdd = $_POST['typeForm'] === 'add';

        var_dump($_POST['typeForm']);

        $id = $isAdd ? max(...array_map(fn($g) => $g->getId(), $this->goodsList)) + 1 : +$_POST['id'];
        $date = date_parse($_POST['date']);
        $item = new Goods(
            $id,
            $_POST['name'],
            new \DateTime($date['year'] . '-' . $date['month'] . '-' . $date['day']),
            +$_POST['price'],
            +$_POST['amount'],
            $_POST['number']
        );

        if ($isAdd)
            array_push($this->goodsList, $item);
        else
            $this->goodsList[key(array_filter($this->goodsList, fn($g) => $g->getId() === $id))] = $item;

        $this->save($this->goodsList);
    }

    // получить запись по id
    function getItemById(int $id): Goods {
        return $this->goodsList[key(array_filter($this->goodsList, fn($g) => $g->getId() === $id))];
    }
}