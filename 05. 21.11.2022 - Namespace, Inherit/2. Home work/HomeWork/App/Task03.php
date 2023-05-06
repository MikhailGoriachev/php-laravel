<?php

namespace App;

use Exception;
use Models\Task03\Planet;
use Models\Task03\PlanetList;

// Задача 3. Обработка файла объектов в формате CSV. Объект – класс Планета (Солнечной системы) с закрытыми свойствами
// название, радиус, масса, количество спутников, тип планеты (каменная, газовый гигант, ледяной гигант), расстояние до
// Солнца в а.е., фотография. По кликам на кнопки типа «submit» реализуйте обработки:
// •	Вывод данных из файла на страницу с упорядочиванием по расстоянию
// •	Вывод данных из файла на страницу с упорядочиванием по алфавиту
// •	Вывод данных из файла на страницу с упорядочиванием по массе
// •	Выборка планет по массе
// •	Выборка планет по типу
// •	Удаление сведений о планете

// обработка по заданию 3
class Task03 {

    // список планет
    public PlanetList $planetList;


    // конструктор
    public function __construct() {
        $this->planetList = new PlanetList();
    }

    // генерация исключения
    public function exceptionDemo(): string {
        try {
            $planet = new Planet(0, '', -20, '', 0, -1, -4, '');
        } catch (Exception $ex) {
            return '<div class="alert alert-danger m-3 w-22rem" role="alert">' .
                   $ex->getMessage() .
                   '</div>';
        }

        return '';
    }

    // сортировка
    public function orderBy(string|null $orderName): void {

        switch ($orderName ?? '') {
            case 'name':
                $this->planetList->orderByName();
                return;
            case 'mass':
                $this->planetList->orderByMass();
                return;
            case 'distance':
                $this->planetList->orderByDistance();
                return;
            default:
                $this->planetList->orderByDefault();
        }

    }

    // выборка планет по массе
    public function selectBy(string|null $selectBy): void {
        switch ($selectBy ?? '') {
            case 'type':
                $type = $_POST['type'];
                if ($type === 'все')
                    $this->planetList->selectByDefault();
                else
                    $this->planetList->selectByType($type);
                return;
            case 'mass':
                $this->planetList->selectByMass($_POST['minMass'], $_POST['maxMass']);
                return;
            default:
                $this->planetList->selectByDefault();
        }
    }

    // вывод в таблицу
    public function toTable(): string {
        return $this->planetList->toTableHTML();
    }
}