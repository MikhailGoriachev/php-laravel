<?php

require_once '../models/PlanetList.php';

// Задача 3. Обработка файла объектов в формате CSV. Объект – класс Планета (Солнечной системы) с закрытыми свойствами название, радиус, масса, количество спутников, расстояние до Солнца в а.е., фотография. Разработайте геттеры и сеттеры с выбросом исключений при не валидных данных. По кликам на кнопки типа «submit» реализуйте обработки:
// •	Демонстрация работы сеттеров (в том числе с не валидными данными) и геттеров – используйте генерацию данных, формы не нужны
// •	Вывод данных из файла на страницу с упорядочиванием по расстоянию
// •	Вывод данных из файла на страницу с упорядочиванием по алфавиту
// •	Вывод данных из файла на страницу с упорядочиванием по массе


// работа по заданию
function task03(): string
{
    $planetList = new PlanetList();

    
    if (isset($_POST['generateException']))
    {
        try {
            $planet = new Planet('', -20, -43, -1, -4, '');
        }   catch (Exception $ex) {
             return '<div class="alert alert-danger m-3 w-22rem" role="alert">'.
                $ex->getMessage().
            '</div>';
        } 
    }
    
    switch ($_POST['orderBy'] ?? '') {
        case 'name':
            $planetList->orderByName();
            return $planetList->toTableHTML();
        case 'mass':
            $planetList->orderByMass();
            return $planetList->toTableHTML();
        case 'distance':
            $planetList->orderByDistance();
            return $planetList->toTableHTML();
        default:
            $planetList->orderByDefault();
            return $planetList->toTableHTML();
    }
    
    
}