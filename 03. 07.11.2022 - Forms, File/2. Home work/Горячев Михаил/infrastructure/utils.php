<?php

// генерация вещественного числа
function random_float(float $min = -10, float $max = 10): float
{
    return random_int($min, $max) + (mt_rand() / mt_getrandmax());
}

// список материлов
function getMaterials(): array
{
    return [
        'steel' => ['rusName' => 'Сталь', 'engName' => 'steel', 'density' => 7_700, 'image' => 'steel.jpg'],
        'aluminium' => ['rusName' => 'Алюминий', 'engName' => 'aluminium', 'density' => 2_712, 'image' => 'aluminium.jpg'],
        'ice' => ['rusName' => 'Лёд', 'engName' => 'ice', 'density' => 916.7, 'image' => 'ice.jpg'],
        'granite' => ['rusName' => 'Гранит', 'engName' => 'granite', 'density' => 2_600, 'image' => 'granite.jpg']
    ];
}

// список фигур
function getFigures(): array
{
    return [
        'conoid' => ['rusName' => 'Конус', 'engName' => 'conoid', 'image' => 'conoid.jpg'],
        'sphere' => ['rusName' => 'Сфера', 'engName' => 'sphere', 'image' => 'sphere.jpg'],
        'cylinder' => ['rusName' => 'Цилиндр', 'engName' => 'cylinder', 'image' => 'cylinder.webp'],
    ];
}