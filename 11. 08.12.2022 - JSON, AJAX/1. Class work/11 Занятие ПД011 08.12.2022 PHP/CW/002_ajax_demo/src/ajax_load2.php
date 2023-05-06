<?php
// данные передаются через load() - это POST-запрос
$value1=$_POST['key1'];
$value2=$_POST['key2'];
$value3=$_POST['key3'];

echo "<h4>Получены данные: $value1, $value2, $value3</h4>";

// обработка данных
$value2 = 2*$value2;
$len = strlen($value1);

// в поток вывода поместить строку
echo "<h4>Новые значения: $value2; длина строки: $len</h4>";