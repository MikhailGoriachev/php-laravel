<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8"/>
    <title>Работа с файлами</title>
    <link href="styles.css" rel="stylesheet">
</head>
<body>
<?php
// работает для веб-серверов: IIS, Apache, Ngnix, Open Server, XAMPP, ...
// upload_tmp_dir = "C:/php/upload",
// максимальный размер одного загружаемого файла
// upload_max_filesize = 2M

if (isset($_FILES['filename']['tmp_name']))
    echo "<h4>папка загруженных файлов, имя временного файла " . $_FILES['filename']['tmp_name'] . "</h4>";

// $_FILES - суперглобальный массив для загруженных файлов
if ($_FILES && $_FILES['filename']['error'] == UPLOAD_ERR_OK) {

    // проверка существования файла, папки file_exists("folder")
    if (!file_exists("uploaded")) {
        mkdir("uploaded");  // создание каталога
    }

    $name = 'uploaded/' . $_FILES['filename']['name'];
    $result = move_uploaded_file($_FILES['filename']['tmp_name'], $name);

    echo "<h4>Файл <span style='color: blue'>$name</span> " . ($result ? '' : 'НЕ ') . 'загружен</h4>';

    // вывод загруженного файла
    view($name);

    // чтение файла целиком, одной операцией в одну строку,
    // т.е. все \r\n заменяются пробелом
    $str = file_get_contents($name);
    echo "<h3>Файл $name прочитан одной операцией</h3>$str<hr/>";

    echo "<h4>Выполняется запись в текстовый файл</h4>";
    write_to_file($name);
    echo "<h4>Запись выполнена</h4>";

    // выводим записанный файл
    echo "<h4>Вывод записанного файла</h4>";
    view($name);


    // проверка существования файла, папки file_exists("folder")
    if (!file_exists("uploaded/folder"))
        mkdir("uploaded/folder");  // создание каталога
    else
        rmdir("uploaded/folder");    // удаление каталога

    // создание и удаление файла
    $fileName = "uploaded/test.txt";
    if (!file_exists($fileName)):
        $fd = fopen($fileName, "w");
        fclose($fd);
    else:
        unlink($fileName);
    endif;

    echo "<br/><hr/><br/>";
} // if


// чтение и вывод файла
function view($name)
{
    // && and   || or   xor
    // @functionName()  -- при работе функции подавляются предупреждения, сообщения об ошибках
    // открыть файл для чтения
    $fd = @fopen($name, 'r') or die("<h4 style='color: tomato'>Не удалось открыть файл $name</h4>");

    while (!feof($fd)):
        // htmlentities() - перекодировка html-разметки для вывода в браузер
        $str = htmlentities(fgets($fd));
        // $str = htmlentities(fread($fd, 4096));
        echo "$str<br/>";
    endwhile;
    fclose($fd);
} // view

// пример записи в текстовый файл, проблема UTF-8-BOM (Byte Order Mask)
function write_to_file($name)
{
    $fd = fopen($name, 'r+') or die("<h4>Не удалось открыть файл $name</h4>");

    $str = "Привет, Hello, world!\r\n"; // строка для записи
    fwrite($fd, $str);    // запишем строку в начало

    // SEEK_SET, SEEK_END, SEEK_SET
    fseek($fd, 0, SEEK_SET);      // поместим указатель файла в начало
    fwrite($fd, "Хрю");         // запишем в начало строку

    fseek($fd, 0, SEEK_END); // поместим указатель в конец
    fwrite($fd, "\r\n");     // запишем в конце еще одну строку - \r\n - перевод строки
    fwrite($fd, $str);
    fclose($fd);
} // write_to_file

?>

<h2>Загрузка файла</h2>
<!-- атрибут enctype='multipart/form-data' указывает на загрузку файлов -->
<form method="post" enctype='multipart/form-data'>
    Выберите файл:
    <input type='file' name='filename' size='10'/>
    <br/>
    <br/>
    <input type='submit' value='Загрузить'/>
</form>
</body>
</html>
