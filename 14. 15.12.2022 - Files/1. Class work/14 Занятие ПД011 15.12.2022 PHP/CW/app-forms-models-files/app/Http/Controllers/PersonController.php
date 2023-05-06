<?php

namespace App\Http\Controllers;

use App\Models\Person;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PersonController extends Controller
{
    // объект для обработки
    private Person $person_;

    // имя файла с данными персон
    private string $fileName_;

    public function __construct()  {
        $this->person_ = new Person("Шавыркина Б.П.", 34, 56000);
        $this->fileName_ = "person.txt";;
    } // _construct

    // создание объекта модели, запись в файл, чтение из файла
    public function demo() {
        // получить диск - ссылку на хранилище, указываем драйвер
        // 's3' - Amazon Cloude
        // 'local' - локальный диск
        $disk = Storage::disk('local');

        // если размер файла больше 300 бафт - удалить файл
        if ($disk->size($this->fileName_) > 500):
            $disk->delete($this->fileName_);
        endif;

        // запись в файл
        $n = 5;
        for ($i = 0; $i < $n; $i++) {
            $disk->append($this->fileName_, $this->person_);
        } // for i

        // чтение из файла
        $content = $disk->get($this->fileName_);

        // покзать прочитаный контент
        return view('person.demo', ['content'=>$content]);
    } // demo

    // запрос вывода формы
    public function getAddPerson() {
        return view('person.add-form');
    } // getAddPerson

    // обарботчик формы
    public function handleAddPerson(Request $request) {
        // чтение из формы
        $fields = $request->all();

        // заполнение полей объекта данными из формы
        $this->person_->fullName = $fields['fullName'];
        $this->person_->age = $fields['age'];
        $this->person_->salary = $fields['salary'];

        // запись в файл, в этом варианте не будем запоминать диск,
        Storage::disk('local')->put($this->fileName_, $this->person_);

        // запись данных в формате CSV
        $csvFileName = "person.csv";
        Storage::disk('local')->put($csvFileName, $this->person_->toCsv());

        // чтение данных из файла в формате CSV
        $str = Storage::disk('local')->get($csvFileName);
        $p1 = new Person();
        $p1->parseCsv($str);

        // в представление выводим данные, введенные в форме
        return view('person.details-person', ['person'=>$this->person_, 'p1'=>$p1]);
    } // handleAddPerson
} // class PersonController
