<?php
    $test = rand(-100, 100);
    // echo "<h4>Это даннные, сформированные сервером: $test</h4>";

    // кодирование пар ключ - значение
    $data = json_encode([ "test"=>$test]);
    echo $data;

