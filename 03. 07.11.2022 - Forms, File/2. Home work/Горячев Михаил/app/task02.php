<?php

// Задача 2. Загружать текстовый файл в кодировке UTF-8 на сервер, папка uploaded в приложении. Выводить на страницу
// текст из файла, форму для ввода текста. По клику на кнопку «Дозапись» записать введенный в поле ввода текст в конец
// файла,  вывести измененный файл (AJAX не использовать). 

const DIR_NAME = '../uploaded';

$pathFile = '';
$fileName = '';

// установка пути к файлу
function setCurrentFile(): void {
    
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

// получить текст файла
function getText(): array
{   
    global $pathFile, $fileName;
    
    if (empty($_POST['currentFile']) && !isset($_FILES['filename']['name']) || !file_exists($pathFile)) {
        $result['error'] = 'Загрузите файл!';
        return $result; 
    }
    
    
    $file = fopen($pathFile, 'r');
    
    $result['content'] = fread($file, filesize($pathFile));
    $result['fileName'] = $fileName;

    fclose($file);

    return $result;
}