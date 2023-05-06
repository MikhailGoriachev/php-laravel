<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Оработка по заданию
class ShoesController extends Controller
{
    // shoes/index: вывод всех записей таблицы
    public function index(): View {

    }

    // shoes/create-form: форма с валидацией для добавление пары обуви
    public function createForm(): View {

    } // createForm

    // shoes/create-handle: обработчик формы добавления пары обуви (с валидацией)
    public function createHandle():View {

    } // createHandle

    // shoes/edit/{code}: форма для редактирования пары обуви,
    //                    по коду товара
    public function editForm($code): View {

    }

    // shoes/edit-handle/{code}: обработчик формы для редактирования пары обуви,
    //                    по коду товара
    public function editHandle($code): View {

    }

    //  shoes/show/{name}: выводит пары обуви заданного наименования
    public function show($name): View {

    }
} // class ShoesController
