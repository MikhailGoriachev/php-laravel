<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

// Примеры на файловые операции
class FileOperationController extends Controller
{
    private $fileName_ = 'data.txt';


    // запись в файл
    public function write()
    {

        // получить диск - ссылку на хранилище, указываем драйвер
        // 's3' - Amazon Cloude
        // 'local' - локальный диск
        $disk = Storage::disk('local');

        $n = random_int(-1000, 1000);

        // собственно запись в файл - старый контент файла стирается
        // первый аргумент: имя файла
        // второй аргумент: произвольный контент
        $disk->put($this->fileName_, "Строка для записи в файл, $n.\nЕще одна строка");

        // дозапись в конец файла, создание файла, если он отсутствует
        $disk->append($this->fileName_, "Строка 1, записанная в конец файла");
        $disk->prepend($this->fileName_, "Строка 2, записанная в начало файла");

        $disk->append($this->fileName_, "Строка 2, записанная в конец файла");
        $disk->append($this->fileName_, "Строка 3, записанная в конец файла");

        $disk->prepend($this->fileName_, "Строка 1, записанная в начало файла");

        return view('file-operation.write', ['n'=>$n]);
    } // write

    // чтение из файла
    public function read()
    {
        // получить диск - ссылку на хранилище, указываем драйвер
        // 's3' - Amazon Cloude
        // 'local' - локальный диск
        $disk = Storage::disk('local');

        // проверка файла на сущестовавание
        if ($disk->exists($this->fileName_)):
            // чтение из файла
            $content = $disk->get($this->fileName_);
        else:
            $content = "Нет файла $this->fileName_";
        endif;

        return view('file-operation.read', ['content'=>$content]);
    } // read

} // class FileOperationController
