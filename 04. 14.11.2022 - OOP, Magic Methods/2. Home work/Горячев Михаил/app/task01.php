<?php

require_once '../../infrastructure/utils.php';
require_once '../../models/Rectangle.php';
require_once '../../models/Square.php';
require_once '../../models/Triangle.php';

// Задача 1. Требуется вычислять параметры плоских геометрических фигур. Параметры фигур вводить в форме. Тип фигуры
// выбирается пользователем, при помощи радиокнопок:
// •	Прямоугольник
// •	Квадрат
// •	Треугольник
//
// Параметры фигуры для вычисления задаются чек-боксами:
// •	площадь
// •	периметр
//
// Собственно вычисление выполнять при клике на кнопку "Вычислить" типа submit. Необходимые числовые параметры вводить
// при помощи строки ввода с типом number. Сохранять исходные данные в куки, если куки определены, выводить данные в
// поля формы из куки.
//
// Требуется также вести журнал операций – текстовый файл, в котором записывать дату и время выполнения расчета,
// исходные данные расчета, результаты расчета.
//
// Предусмотрите страницу для просмотра журнала, очистки журнала.  


const FILE_NAME = 'history.csv';
const DIR_NAME = '../../App_Data';
const COOKIE_DURATION_TIME = 3600 * 24 * 10;

// обработка формы
function formHandler(): array
{
    // тип фигуры
    $figure = $_POST['figure'];

    $a = +$_POST['a'];
    $b = empty($_POST['b']) ? NAN : +$_POST['b'];
    $c = empty($_POST['c']) ? NAN : +$_POST['c'];

    $isPerimeter = isset($_POST['isPerimeter']);
    $isArea = isset($_POST['isArea']);
    
    // запись данных в куки
    setcookie('figure', $figure, COOKIE_DURATION_TIME + time());
    setcookie('a', $a, COOKIE_DURATION_TIME + time());
    setcookie('b', $b, COOKIE_DURATION_TIME + time());
    setcookie('c', $c, COOKIE_DURATION_TIME + time());
    setcookie('isPerimeter', $isPerimeter ? 'checked' : '', COOKIE_DURATION_TIME + time());
    setcookie('isArea', $isArea ? 'checked' : '', COOKIE_DURATION_TIME + time());

    if ($figure === 'rectangle' && is_nan($b)) {
        return ['error' => 'Для прямоугольника должны быть указаны стороны A и B'];
    }

    if ($figure === 'triangle' && (is_nan($b) || is_nan($c))) {
        return ['error' => 'Для треугольника должны быть указаны стороны A, B и C'];
    }

    try {
        $result = match ($figure) {
            'square' => figureProc(new Square($a), $isArea, $isPerimeter),
            'rectangle' => figureProc(new Rectangle($a, $b), $isArea, $isPerimeter),
            'triangle' => figureProc(new Triangle($a, $b, $c), $isArea, $isPerimeter),
        };
    } catch (Exception $ex) {
        return ['error' => $ex->getMessage()];
    }

    return $result;
}

// вычисление данных фигуры
function figureProc($figure, bool $isArea, bool $isPerimeter): array
{
    $result = [
        'figureImage' => $figure->image,
        'name' => $figure->name,
        'a' => method_exists($figure, 'getA') ? $figure->getA() : null,
        'b' => method_exists($figure, 'getB') ? $figure->getB() : null,
        'c' => method_exists($figure, 'getC') ? $figure->getC() : null,
        'perimeter' => $isPerimeter ? $figure->perimeter() : null,
        'area' => $isArea ? $figure->area() : null,
    ];

    writeResultToFile($result);

    return $result;
}

// запись в файл данных
function writeResultToFile(array $result): void
{
    date_default_timezone_set('UTC');

    checkOrCreateFile(DIR_NAME, FILE_NAME);
    
    $file = fopen(DIR_NAME . '/' . FILE_NAME, 'a');

    $result['date'] = date("d-m-Y H:i:s", idate('U'));

    fputcsv($file, $result);
    fclose($file);
}

// получить историю
function getHistory(): array
{
    try {
        $path = DIR_NAME . '/' . FILE_NAME;

        checkOrCreateFile(DIR_NAME, FILE_NAME);
        
        $file = fopen($path, 'r');

        $result['content'] = [];

        while (!feof($file)) {
            $buf = fgetcsv($file);

            if (is_array($buf))
                $result['content'][] = $buf;
        }

        fclose($file);

        if (count($result['content']) === 0)
            $result['error'] = 'История пуста!';
    } catch (Exception $ex) {
        $result['error'] = $ex->getMessage();
    }

    return $result;
}

// очистка журнала
function removeHistory(): void
{
    $file = fopen(DIR_NAME . '/' . FILE_NAME, 'w');
    fclose($file);
}