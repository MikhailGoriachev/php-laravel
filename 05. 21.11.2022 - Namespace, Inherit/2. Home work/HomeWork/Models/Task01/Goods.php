<?php

namespace Models\Task01;

use DateTime;
use Exception;

// Класс Товар
class Goods {

    // id
    private int $id;

    public function getId(): int { return $this->id; }

    public function setId($id) { return $this->id = $id; }


    // наименование товара
    private string $name;

    public function getName(): string { return $this->name; }

    public function setName(string $name): void {
        $this->name = !empty($name) ? $name : throw new Exception('Поле Name не может быть пустым');
    }


    // дата оформления
    private DateTime $date;

    public function getDate(): DateTime { return $this->date; }

    public function setDate(DateTime $date): void { $this->date = $date; }


    // цена единицы товара
    private float $price;

    public function getPrice(): float { return $this->price; }

    public function setPrice(float $price): void {
        $this->price = $price > 0 ? $price : throw new Exception('Значение поля Price должно быть больше нуля');
    }


    // количество единиц товара
    private int $amount;

    public function getAmount(): int { return $this->amount; }

    public function setAmount(int $amount): void {
        $this->amount = $amount > 0 ? $amount : throw new Exception('Значение поля Amount должно быть больше нуля');
    }


    // номер накладной
    private string $number;

    public function getNumber(): string { return $this->number; }

    public function setNumber(string $number): void {
        $this->number = $number > 0 ? $number : throw new Exception('Значение поля Number должно быть больше нуля');
    }


    // конструктор
    public function __construct(int $id, string $name, DateTime $date, float $price, int $amount, string $number) {
        $this->setId($id);
        $this->setName($name);
        $this->setDate($date);
        $this->setPrice($price);
        $this->setAmount($amount);
        $this->setNumber($number);
    }


    // вычисление стоимости товара
    public function getCost(): float { return $this->price * $this->amount; }

    // строковое представление объекта
    public function __toString(): string {
        return "Name: $this->name; Date: $this->date; Price: $this->price; Amount: $this->amount; Number: $this->number";
    }

    // строка таблицы
    public function toTableRow(): string {
        return "<tr>
                    <td>$this->id</td>
                    <td>$this->name</td>
                    <td>{$this->date->format('d-m-Y')}</td>
                    <td>$this->number</td>
                    <td>$this->price</td>
                    <td>$this->amount</td>
                    <td>{$this->getCost()}</td>
                    <td class='text-center'>
                        <form class='d-inline' action='/pages/task01/goodsForm.php' method='post'>
                            <button class='btn btn-outline-primary' type='submit' name='edit' value='$this->id' 
                                    title='Изменить...'>
                                <i class='bi bi-pencil-fill'></i>
                            </button>
                        </form>
                        <form class='d-inline' method='post'>
                            <button class='btn btn-outline-danger' type='submit' name='remove' value='$this->id'
                                    title='Удалить'>
                                <i class='bi bi-trash-fill'></i>
                            </button>
                        </form>
                    </td>
                </tr>";
    }

    // получить массив из объекта для записи в csv формате
    public function getArrayToScv(): array {
        return [
            $this->getId(),
            $this->getName(),
            $this->getDate()->getTimestamp(),
            $this->getPrice(),
            $this->getNumber(),
            $this->getAmount()
        ];
    }

    // установить данные в объект из массива
    static public function setDataFromArrayScv(array $array): Goods {
        return new Goods($array[0], $array[1], (new DateTime())->setTimestamp($array[2]), $array[3], $array[5], $array[4]);
    }
}