<?php

// генерация вещественного числа
function random_float(float $min = -10, float $max = 10): float
{
    return random_int($min, $max) + (mt_rand() / mt_getrandmax());
}

// список фигур
function getFigures(): array
{
    return [
        'rectangle' => ['rusName' => 'Прямоугольник', 'engName' => 'rectangle', 'image' => 'rectangle.jpg'],
        'square' => ['rusName' => 'Квадрат', 'engName' => 'square', 'image' => 'square.jpg'],
        'triangle' => ['rusName' => 'Треугольник', 'engName' => 'triangle', 'image' => 'triangle.jpg'],
    ];
}

// создать файл
function checkOrCreateFile(string $dirName, string $fileName): void {
    if (!file_exists($dirName))
        mkdir($dirName);

    $file = fopen($dirName . '/' . $fileName, 'a');
    fclose($file);
}