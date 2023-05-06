<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    // отображение формы
    // GET /form1
    public function form1() {
        return view('post.form1');
    } // form1

    // обработка формы
    // GET /handle1 обработчик для form1
    // Request $request - внедрение зависимости для получения данных HTTP request
    public function handle1(Request $request) {
        $fullName = $request->input('fullName');
        $age = $request->input('age');
        $skill = $request->input('skill');
        $certified = $request->input('certified');

        return view('post.handle1', ['fullName' => $fullName, 'age' => $age, 'skill'=>$skill, 'certified' => $certified]);
    } // handle1

    // отображение формы
    // GET /form2
    public function form2() {
        return view('post.form2');
    } // form2

    // обработка формы
    // POST /handle2 обработчик для form2
    // Request $request - внедрение зависимости для полусения данных HTTP request
    public function handle2(Request $request, $id=1) {
        // чтение данных из полей ввода по именам полей ввода
        $fullName = $request->input('fullName');
        $age = $request->input('age');
        $skill = $request->input('skill');
        $certified = $request->input('certified');

        // получить все данные формы в один массив
        // (полезно, когда в форме много полей ввода)
        $data = $request->all();

        // доступ к полям ввода - через индексмирование
        // именами полей ввода, доступ и по чтению и по
        // записи
        $data['age']++;

        return view('post.handle2', [
            'fullName' => $fullName,   // прочитано из поля ввода
            'age' => $age,             // прочитано из поля ввода
            'skill' => $skill,         // прочитано из поля ввода
            'certified' => $certified, // прочитано из поля ввода
            'data'=>$data,             // прочитано из массива данных полей ввода
            'id'=>$id                  // параметр из маршрута
        ]);
    } // handle2


}
