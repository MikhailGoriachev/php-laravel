<!DOCTYPE html>
<html lang="ru">
<head>
    <title>Введение в регулярные выражения</title>
	<meta charset="utf-8">
    <link href="styles.css" rel="stylesheet">
</head>
<body>

<?php
$str = "Телефоны нашей компании: <br>    8 (495) 123-45-67 - офис в Москве;<br>    1-212-555-75-75 - офис в Нью-Йорке.";

echo "Исходная строка: <br><pre>$str</pre>";

// Шаблон регулярного выражения
$pattern = '/(\d+)[\s|\(|-]*([\d]{3,})[\s|\)|-]*([\d|-]+)/';
preg_match_all($pattern, $str, $arr, PREG_SET_ORDER);

foreach ($arr as $entry){
    echo "<pre><br>Найденное совпадение: <b>".$entry[0]."</b><br>    "
        ."Код страны: <em>".$entry[1]."</em><br>    "
        ."Код города: <em>".$entry[2]."</em><br>    "
        ."Номер: <em>".$entry[3]."</em><br>";
}
?>

<form method="post">
    <input type="text" name="url" placeholder="Введите целевой URL"><br>
    <input type="submit" value="Получить ссылки">
</form>

<?php

function print_links($url) {
    $fp = fopen($url, "r") or die("Невозможно открыть файл $url");
    $page_contents = "";
    $pattern = '/<a \s+ href=" ([^"]+) " \s*> ([^>]*) <\/a>/ix';

    while ($new_text = fread($fp, 100)) {
        $page_contents .= $new_text;
    }

    $match_result = preg_match_all($pattern, $page_contents, $match_array, PREG_SET_ORDER);

    foreach ($match_array as $entry){
        $href = $entry[1];
        $anchor = $entry[2];
        print("<br><b>href</b>: $href;<br><b>анкор</b>: $anchor<br>");
    }
}

print_links('http://lib.ru');

if (isset($_POST['url'])):
    print_links($_POST['url']);
endif;

?>
</body>
</html>
