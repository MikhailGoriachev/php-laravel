<?php

require_once '../../infrastructure/utils.php';

// Задача 1. Требуется вычислять параметры геометрических тел по выбору пользователя. Параметры тел вводить в элементы
// интерфейса.
// •	площадь поверхности 
// •	объем
// •	масса
// Типы тел по выбору пользователя:
// •	конус
// •	сфера
// •	цилиндр
// Варианты материала, из которого изготовлено тело:
// •	сталь
// •	алюминий
// •	водяной лед
// •	гранит
//
// Тип фигуры и материал выбирать из выпадающих списков. Необходимые числовые параметры вводить при помощи строки ввода
// с типом number. Параметры вычисления задавать чек-боксами, собственно вычисление выполнять при клике на кнопку
// "Вычислить" типа submit. В результаты вычислений должны также включаться изображения выбранного тела и материала,
// из которого изготовлено тело.
//
// Требуется также вести журнал операций – текстовый файл, в котором записывать дату и время выполнения расчета,
// исходные данные расчета, результаты расчета. Предусмотрите страницу для просмотра журнала, очистки журнала.

const FILE_NAME = 'history.txt';
const DIR_NAME = '../../App_Data';

// обработка формы
function formHandler(): array
{
    // тип фигуры
    $figure = $_POST['figure'];

    if ($figure !== 'sphere' && empty($_POST['height'])) {
        return ['error' => 'Высота не указана!'];
    }

    return match ($figure) {
        'conoid' => conoidProc(+$_POST['height'], +$_POST['radius'], $_POST['material'],
            isset($_POST['isArea']), isset($_POST['isVolume']), isset($_POST['isMass'])),

        'sphere' => sphereProc(+$_POST['radius'], $_POST['material'], isset($_POST['isArea']),
            isset($_POST['isVolume']), isset($_POST['isMass'])),

        'cylinder' => cylinderProc(+$_POST['height'], +$_POST['radius'], $_POST['material'],
            isset($_POST['isArea']), isset($_POST['isVolume']), isset($_POST['isMass'])),
    };
}

// вычисление данных конуса
function conoidProc(float $height, float $radius, string $materialName, bool $isArea = false, bool $isVolume = false, bool $isMass = false): array
{
    $figure = getFigures()['conoid'];
    $material = getMaterials()[$materialName];
    $density = $material['density'];

    $result = [
        'name' => $figure['rusName'],
        'figureImage' => $figure['image'],
        'material' => $material['rusName'],
        'materialImage' => $material['image'],
        'radius' => $radius,
        'height' => $height,
        'density' => $density
    ];

    if ($isArea)
        $result['area'] = M_PI * $radius ** 2 + M_PI * $radius * (sqrt($radius ** 2 + $height ** 2));

    if ($isVolume)
        $result['volume'] = $height * M_PI * $radius ** 2 / 3;

    if ($isMass)
        $result['mass'] = $density * (1 / 3) * M_PI * $height * $radius ** 2;

    writeResultToFile($result);

    return $result;
}

// вычисление данных сферы
function sphereProc(float $radius, string $materialName, bool $isArea = false, bool $isVolume = false, bool $isMass = false): array
{
    $figure = getFigures()['sphere'];
    $material = getMaterials()[$materialName];
    $density = $material['density'];

    $result = [
        'name' => $figure['rusName'],
        'figureImage' => $figure['image'],
        'material' => $material['rusName'],
        'materialImage' => $material['image'],
        'radius' => $radius,
        'density' => $density
    ];


    if ($isArea)
        $result['area'] = 4 * M_PI * $radius ** 2;

    if ($isVolume)
        $result['volume'] = (4 / 3) * M_PI * M_PI ** 3;

    if ($isMass)
        $result['mass'] = (4 / 3) * M_PI * M_PI ** 3 * $density;

    writeResultToFile($result);

    return $result;
}


// вычисление данных цилиндра
function cylinderProc(float $height, float $radius, string $materialName, bool $isArea = false, bool $isVolume = false, bool $isMass = false): array
{
    $figure = getFigures()['cylinder'];
    $material = getMaterials()[$materialName];
    $density = $material['density'];

    $result = [
        'name' => $figure['rusName'],
        'figureImage' => $figure['image'],
        'material' => $material['rusName'],
        'materialImage' => $material['image'],
        'radius' => $radius,
        'height' => $height,
        'density' => $density
    ];

    if ($isArea)
        $result['area'] = 2 * M_PI * $radius * ($height + $radius);

    if ($isVolume)
        $result['volume'] = M_PI * $radius ** 2 * $height;

    if ($isMass)
        $result['mass'] = M_PI * $radius ** 2 * $height * $density;

    writeResultToFile($result);

    return $result;
}

// запись в файл данных
function writeResultToFile(array $result): void
{
    date_default_timezone_set('UTC');

    if (!file_exists(DIR_NAME))
        mkdir(DIR_NAME);

    $file = fopen(DIR_NAME . '/' . FILE_NAME, 'a+');
    
    $line = '[' . date("d-m-Y H:i:s", idate('U')) . '] ';

    foreach ($result as $key => $value) {
        $line .= $key . ': ' . $value . '; ';
    }

    fwrite($file, $line . PHP_EOL);
    fclose($file);
}

// получить историю
function getHistory() : array {
    
    $path = DIR_NAME . '/' . FILE_NAME;
    
    if (!file_exists($path)) {
        $result['error'] = 'История пуста!';
        return $result;
    }
    
    $file = fopen($path, 'r');
    
    $result['content'] = fread($file, filesize($path));
    
    fclose($file);
    
    return $result;
}

// очистка журнала
function removeHistory() : void {
    unlink(DIR_NAME . '/' . FILE_NAME);
}