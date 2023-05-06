<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Symfony\Component\Console\Helper\Table;

class CarRentalsController extends Controller {

    #region Таблицы

    // модели
    public function brands(): View {

        return view('carRentals.tables.brands', [
            'data' => DB::table('brands')->get()
        ]);
    }


    // цвета
    public function colors(): View {
        return view('carRentals.tables.colors', [
            'data' => DB::table('colors')->get()
        ]);
    }


    // клиенты
    public function clients(): View {
        return view('carRentals.tables.clients', [
            'data' => DB::table('clients')->get()
        ]);
    }


    // автомобили
    public function cars(): View {
        return view('carRentals.tables.cars', [
            'data' => DB::table('cars_view')->get()
        ]);
    }


    // прокаты
    public function rentals(): View {
        return view('carRentals.tables.rentals', [
            'data' => DB::table('rentals_view')->orderBy('id')->get()
        ]);
    }


    #endregion


    #region CRUD

    // добавление проката
    public function addRentalForm(): View {

        // клиенты
        $clients = DB::table('clients')->get();

        // автомобили
        $cars = DB::table('cars_view')->get();

        return view('carRentals.forms.rentalForm', [
            'isAdd' => true,
            'clients' => $clients->map(fn($a) => ['key' => $a->id, 'value' => "$a->id. $a->last_name $a->first_name $a->patronymic"]),
            'cars' => $cars->map(fn($a) => ['key' => $a->id, 'value' => "$a->id. $a->brand_name $a->plate $a->color_name"])
        ]);
    }

    public function addRental(Request $request): View {

        $fields = $request->validate([
            'id_client' => 'bail|required|integer',
            'id_car' => 'bail|required|integer',
            'date_start' => 'bail|required|date',
            'duration' => 'bail|required|integer|min:1',
        ]);

        DB::table('rentals')->insertGetId([
            'id_client' => $fields['id_client'],
            'id_car' => $fields['id_car'],
            'date_start' => $fields['date_start'],
            'duration' => $fields['duration']
        ]);

        return $this->rentals();
    }


    // изменение проката
    public function editRentalForm(string|int $id): View {

        // клиенты
        $clients = DB::table('clients')->get();

        // автомобили
        $cars = DB::table('cars_view')->get();

        $rental = DB::table('rentals')->where('id', $id)->get()->first();

        return view('carRentals.forms.rentalForm', [
            'isAdd' => false,
            'id' => $rental->id,
            'id_client' => $rental->id_client,
            'id_car' => $rental->id_car,
            'duration' => $rental->duration,
            'date_start' => $rental->date_start,
            'clients' => $clients->map(fn($a) => ['key' => $a->id, 'value' => "$a->id. $a->last_name $a->first_name $a->patronymic"]),
            'cars' => $cars->map(fn($a) => ['key' => $a->id, 'value' => "$a->id. $a->brand_name $a->plate $a->color_name"])
        ]);
    }

    public function editRental(Request $request): View {

        $fields = $request->validate([
            'id' => 'bail|required|integer',
            'id_client' => 'bail|required|integer',
            'id_car' => 'bail|required|integer',
            'date_start' => 'bail|required|date',
            'duration' => 'bail|required|integer|min:1',
        ]);

//        $dateStart = date_parse($fields['date_start']);
//        $dateStart = "{$dateStart['year']}-{$dateStart['month']}-{$dateStart['day']}";

        dump($fields);

        DB::table('rentals')->where('id', $fields['id'])->update([
            'id_client' => $fields['id_client'],
            'id_car' => $fields['id_car'],
            'date_start' => $fields['date_start'],
            'duration' => $fields['duration']
        ]);

        return $this->rentals();
    }


    // удаление проката
    public function removeRental(int|string $id): View {
        DB::table('rentals')->where('id', $id)->delete();

        return $this->rentals();
    }

    #endregion


    #region Запросы

    // 1. Запрос на выборку.
    // Выбирает информацию об автомобилях, стоимость одного дня проката которых меньше заданной
    public function query01Form(): View {
        return view('carRentals.queries.query01', [
            'data' => DB::table('cars_view')->get()
        ]);
    }

    public function query01(Request $request): View {

        $fields = $request->validate([
            'min_rental' => 'bail|required|integer|min:1'
        ]);

        $minRental = $fields['min_rental'];

        $data = DB::table('cars_view')->where('rental', '>', $minRental)->get();

        return view('carRentals.queries.query01', [
            'min_rental' => $minRental,
            'data' => $data
        ]);
    }


    // 2. Запрос на выборку.
    // Выбирает из таблицы информацию об автомобилях, страховая стоимость которых находится в заданном диапазоне
    public function query02Form(): View {
        return view('carRentals.queries.query02', [
            'data' => DB::table('cars_view')->get()
        ]);
    }

    public function query02(Request $request): View {

        $fields = $request->validate([
            'min_insurance_pay' => 'bail|required|integer|min:1',
            'max_insurance_pay' => "bail|required|integer|min:{$request->get('min_insurance_pay')}",
        ]);

        $min_insurance_pay = $fields['min_insurance_pay'];
        $max_insurance_pay = $fields['max_insurance_pay'];

        $data = DB::table('cars_view')
            ->whereBetween('inshurance_pay', [$min_insurance_pay, $max_insurance_pay])
            ->get();

        return view('carRentals.queries.query05', [
            'min_insurance_pay' => $min_insurance_pay,
            'max_insurance_pay' => $max_insurance_pay,
            'data' => $data
        ]);
    }

    // 3. Запрос на выборку.
    // Выбирает информацию о клиентах, серия-номер паспорта которых начинается с заданной цифры.
    // Включает поля Код клиента, Паспорт, Дата начала проката, Количество дней проката, Модель автомобиля
    public function query03Form(): View {
        return view('carRentals.queries.query03', [
            'data' => DB::table('rentals_view')->get()
        ]);
    }

    public function query03(Request $request): View {

        $fields = $request->validate([
            'passport' => 'bail|required|min:1',
        ]);

        $passport = $fields['passport'];

        $data = DB::table('rentals_view')->where('passport', 'regexp', '^' . $passport)->get();

        return view('carRentals.queries.query03', [
            'passport' => $passport,
            'data' => $data
        ]);
    }

    // 4. Запрос на выборку.
    // Выбирает их информацию о клиентах, бравших автомобиль напрокат в некоторый определенный день.
    public function query04Form(): View {
        return view('carRentals.queries.query04', [
            'data' => DB::table('rentals_view')->get()
        ]);
    }

    public function query04(Request $request): View {

        $fields = $request->validate([
            'date_start' => 'required|date',
        ]);

        $dateStart = date_parse($fields['date_start']);
        $dateStart = "{$dateStart['year']}-{$dateStart['month']}-{$dateStart['day']}";

        $data = DB::table('rentals_view')->where('date_start', '=', $dateStart)->get();

        return view('carRentals.queries.query04', [
            'date_start' => $dateStart,
            'data' => $data
        ]);
    }

    // 5. Запрос на выборку.
    // Выбирает информацию обо всех автомобилях, для которых значение в поле Страховая стоимость автомобиля
    // попадает в некоторый заданный интервал.
    public function query05Form(): View {
        return view('carRentals.queries.query05', [
            'data' => DB::table('cars_view')->get()
        ]);
    }

    public function query05(Request $request): View {

        $fields = $request->validate([
            'min_insurance_pay' => 'bail|required|integer|min:1',
            'max_insurance_pay' => "bail|required|integer|min:{$request->get('min_insurance_pay')}",
        ]);

        $min_insurance_pay = $fields['min_insurance_pay'];
        $max_insurance_pay = $fields['max_insurance_pay'];

        $data = DB::table('cars_view')
            ->whereBetween('inshurance_pay', [$min_insurance_pay, $max_insurance_pay])
            ->get();

        return view('carRentals.queries.query05', [
            'min_insurance_pay' => $min_insurance_pay,
            'max_insurance_pay' => $max_insurance_pay,
            'data' => $data
        ]);
    }


    // 6. Запрос с вычисляемыми полями. Вычисляет для каждого автомобиля величину выплачиваемого страхового взноса.
    // Включает поля Госномер автомобиля, Модель автомобиля, Год выпуска автомобиля, Страховая стоимость автомобиля,
    // Страховой взнос. Сортировка по полю Год выпуска автомобиля
    public function query06(): View {

        $data = DB::table('cars_view')->orderBy('year_manufacture')->get();

        return view('carRentals.queries.query06', [
            'data' => $data
        ]);
    }

    #endregion

}
