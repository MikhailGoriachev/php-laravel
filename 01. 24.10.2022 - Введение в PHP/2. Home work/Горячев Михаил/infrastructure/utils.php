<?php

// генерация вещественного числа
function random_float(float $min, float $max): float {
    return random_int($min, $max) + random_int(1e6, 1e7) / 1e6;
}