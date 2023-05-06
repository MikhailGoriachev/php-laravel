<?php

// Задача 2. Загружать текстовый файл в кодировке UTF-8 на сервер, папка uploaded в приложении. Выводить на страницу
// текст из файла, форму для ввода текста. По клику на кнопку «Дозапись» записать введенный в поле ввода текст в конец
// файла,  вывести измененный файл (AJAX не использовать). 

const DIR_NAME = '../uploaded';

$pathFile = '';
$fileName = '';

// работа по заданию
function task02(): void
{
    setCurrentFile();

    uploadFile();

    addText();
}

// установка пути к файлу
function setCurrentFile(): void
{

    global $pathFile, $fileName;

    if (empty($_POST['currentFile']) && !isset($_FILES['filename']['name'])) {
        $pathFile = '';
        return;
    }

    $fileName = empty($_POST['currentFile']) ? $_FILES['filename']['name'] : $_POST['currentFile'];
    $pathFile = DIR_NAME . '/' . $fileName;
}

// загрузка файла на сервер
function uploadFile(): bool
{
    if ($_FILES && $_FILES['filename']['error'] === UPLOAD_ERR_OK) {

        if (!file_exists(DIR_NAME))
            mkdir(DIR_NAME);

        return move_uploaded_file($_FILES['filename']['tmp_name'], DIR_NAME . '/' . $_FILES['filename']['name']);
    }

    return false;
}

// добавление текста в файл
function addText(): void
{   
    global $pathFile;

    if (empty($_POST['text']) || !file_exists($pathFile))
        return;

    $text = $_POST['text'];

    if (!file_exists(DIR_NAME))
        mkdir(DIR_NAME);

    $file = fopen($pathFile, 'a+');

    fwrite($file, $text);
    fclose($file);
}

// получить текст
function getText(): array {
    $handleType = $_POST['handleType'] ?? 'default';
     switch ($handleType) {
     	// только строки, содержащие двузначные числа.
     	// только строки, не содержащие символов ".,!?:"

         case 'numbers':
             $result = getTextRegex(fn($line) => preg_match('/\b\d{2}\b/', $line));
             $result['name'] = 'Только строки, содержащие двузначные числа';
             return $result;

         case 'withoutSpecSymbol':
             $result = getTextRegex(fn($line) => !preg_match('/[.,!?:]/', $line));
             $result['name'] = 'Только строки, не содержащие символов ".,!?:"';
             return $result;

         default:
             $result = getTextRegex(fn() => true);
             $result['name'] = 'Все строки';
             return $result;
     }
}

// получить текст файла со строками, по регулярному выражению
function getTextRegex(callable $linePred): array
{
    global $pathFile, $fileName;

    if (empty($_POST['currentFile']) && !isset($_FILES['filename']['name']) || !file_exists($pathFile)) {
        $result['error'] = 'Загрузите файл!';
        return $result;
    }

    $file = fopen($pathFile, 'r');

    $result['content'] = '';
    while (!feof($file)) {
        $line = fgets($file);
        
        $result['content'] .= $linePred($line) ? $line : '';
    }

    $result['fileName'] = $fileName;

    fclose($file);

    return $result;
}