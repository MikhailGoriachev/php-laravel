<?php

    // часть параметров передаем по значению, два последних - по ссылке
    function rectPS($x1, $y1, $x2, $y2, &$p, &$s) {
        // длины сторон
        $a = abs($x1 - $x2);
        $b = abs($y1 - $y2);

        // вычисление периметра и площади
        $p = 2 * ($a + $b);
        $s = $a * $b;
    } //  rectPS

# в файле, содержащем чистый PHP-код закрывающий тег не нужен
