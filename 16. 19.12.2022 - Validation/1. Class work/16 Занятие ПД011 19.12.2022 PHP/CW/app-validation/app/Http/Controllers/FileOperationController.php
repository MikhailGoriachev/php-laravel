<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use TheSeer\Tokenizer\Exception;

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

    // -------------------------------- 17/12/2022 ----------------------------------

    // показать форму для загрузки файла
    public function uploadFile() {
        return view('file-operation.upload-form');
    } // uploadFile

    // Обработка формы загрузки фалйа - сохранить загруженный файл
    public function upload(Request $request) {
        // сохранение в storage/app с автосегенерированным именем,
        // расширеник имени файла определяется по контенту (по MIME-типу)
        // $path = $request->file('dataFile')->store('');

        // сохранение в storage/app/uploaded с автосегенерированным именем,
        // расширеник имени файла определяется по контенту (по MIME-типу)
        // $path = $request->file('dataFile')->store('uploaded');

        // сохранение в storage/app с оригинальным именем и ресширением
        $file = $request->file('dataFile');

        // оригинальное имя файла вместе с расширением
        $clientOriginalName = $file->getClientOriginalName();

        // собственно оригнальное расширение
        // $extension = $file->getClientOriginalExtension();

        // $path = $file->storeAs('', $clientOriginalName);

        // сохранить в каталоге uploaded для дальнейшего использования в приложении
        $path = $file->storeAs('public/uploaded', $clientOriginalName);
        $pathUrl = Storage::url($path);

        // генерация имени, определение расширения по MIME-типу
        // $clientOriginalName = $file->hashName();       // имя включает в себя расширение
        // $extension = $file->extension(); // Determine the file's extension based on the file's MIME type...
        // $path = $file->storeAs('uploaded', $clientOriginalName);

        // задание произвольного имени и типа файла
        // $path = $file->storeAs('uploaded', 'произвольное_имя_файла.тип_файла');

        return view('file-operation.upload-result', ['clientOriginalName'=>$clientOriginalName, 'path'=>$path, 'pathUrl'=>$pathUrl] );
    } // upload

    // выполнить скачивание файла с сервера
    public function downloadFile() {
        // получить диск - ссылку на хранилище, указываем драйвер
        // 's3' - Amazon Cloud
        // 'local' - локальный диск
        $disk = Storage::disk('local');

        // при отсутствии файла выброс исключения
        if (!$disk->exists($this->fileName_)):
            throw new Exception("Файл $this->fileName_ не найден");
        endif;

        // скачть существующий файл
        // TODO: вывести сообщение об успешном скачивании
        return Storage::download($this->fileName_);
    } // downloadFile

} // class FileOperationController
