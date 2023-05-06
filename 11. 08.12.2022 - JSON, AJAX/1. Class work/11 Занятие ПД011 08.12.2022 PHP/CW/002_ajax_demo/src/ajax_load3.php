<?php

date_default_timezone_set('Europe/Moscow');
$date_today = date("d.m.y", time());
$now_time = date("H:i:s", time());

// в поток вывода поместить текст
echo "<h4>Еще один блок данных, сформированный сервером</h4>"
     ."<p>Какой-то текст, сформированный очень крутым скриптом на сервере дальнем</p>"
    . "<p>Сегодня <b>$date_today</b>, сейчас <u>$now_time</u></p>";
?>