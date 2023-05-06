<?php

namespace App;

use Exception;
use Infrastructure\Utils;
use Models\Goods;
use Models\Planet;
use Models\PlanetList;

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
            $planet = new Planet('', -20, -43, -1, -4, '');
        } catch (Exception $ex) {
            return '<div class="alert alert-danger m-3 w-22rem" role="alert">' .
                   $ex->getMessage() .
                   '</div>';
        }

        return '';
    }

    // сортировка
    public function orderBy(string|null $orderName): string {
        switch ($orderName ?? '') {
            case 'name':
                $this->planetList->orderByName();
                return $this->planetList->toTableHTML();
            case 'mass':
                $this->planetList->orderByMass();
                return $this->planetList->toTableHTML();
            case 'distance':
                $this->planetList->orderByDistance();
                return $this->planetList->toTableHTML();
            default:
                $this->planetList->orderByDefault();
                return $this->planetList->toTableHTML();
        }
    }
}