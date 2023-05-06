<?php
// данные передаются через load() - это POST-запрос
$value1=$_POST['key1'];
$value2=$_POST['key2'];
$value3=$_POST['key3'];

echo "<h3>Получены данные: $value1, $value2, $value3</h3>";
$value2 = 2*$value2;
$len = strlen($value1);

date_default_timezone_set('Europe/Moscow');
$date_today = date("d.m.y", time());
$now_time = date("H:i:s", time());

echo "<h4>Отправлено сервером:</h4>
      <h4>Сегодня $date_today, сейчас: <u>$now_time</u></h4>
      <h4>Новые значения: $value2; длина строки: $len</h4>"
?>
