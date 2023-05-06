<?php

// генерация вещественного числа
function random_float(float $min = -10, float $max = 10): float {
    return random_int($min, $max) + (mt_rand() / mt_getrandmax());
}