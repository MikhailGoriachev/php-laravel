<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Car;
use App\Models\Client;
use App\Models\Color;
use App\Models\Rental;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Symfony\Component\Console\Helper\Table;

class CarRentalsController extends Controller {

    #region Таблицы

    // модели
    public function brands(): View {

        return view('carRentals.tables.brands', [
            'data' => Brand::all()
        ]);
    }


    // цвета
    public function colors(): View {
        return view('carRentals.tables.colors', [
            'data' => Color::all()
        ]);
    }


    // клиенты
    public function clients(): View {
        return view('carRentals.tables.clients', [
            'data' => Client::all()
        ]);
    }


    // автомобили
    public function cars(): View {
        return view('carRentals.tables.cars', [
            'data' => Car::with('brand', 'color')->get()
        ]);
    }


    // прокаты
    public function rentals(): View {
        return view('carRentals.tables.rentals', [
            'data' => Rental::with('car', 'client')->get()
        ]);
    }


    #endregion


    #region CRUD

    // добавление проката
    public function addRentalForm(): View {

        // клиенты
        $clients = Client::all();

        // автомобили
        $cars = Car::all();

        return view('carRentals.forms.rentalForm', [
            'isAdd' => true,
            'clients' => $clients->map(fn($a) => ['key' => $a->id, 'value' => "$a->id. $a->last_name $a->first_name $a->patronymic"]),
            'cars' => $cars->map(fn($a) => ['key' => $a->id, 'value' => "$a->id. {$a->brand->name} $a->plate {$a->color->name}"])
        ]);
    }

    public function addRental(Request $request): View {

        $fields = $request->validate([
            'client_id' => 'bail|required|integer',
            'car_id' => 'bail|required|integer',
            'date_start' => 'bail|required|date',
            'duration' => 'bail|required|integer|min:1',
        ]);

        $rental = new Rental([
            'client_id' => $fields['client_id'],
            'car_id' => $fields['car_id'],
            'date_start' => $fields['date_start'],
            'duration' => $fields['duration']
        ]);

        $rental->save();

        return $this->rentals();
    }


    // изменение проката
    public function editRentalForm(string|int $id): View {

        // клиенты
        $clients = Client::all();

        // автомобили
        $cars = Car::all();

        $rental = DB::table('rentals')->where('id', $id)->get()->first();

        return view('carRentals.forms.rentalForm', [
            'isAdd' => false,
            'id' => $rental->id,
            'client_id' => $rental->client_id,
            'car_id' => $rental->car_id,
            'duration' => $rental->duration,
            'date_start' => $rental->date_start,
            'clients' => $clients->map(fn($a) => ['key' => $a->id, 'value' => "$a->id. $a->last_name $a->first_name $a->patronymic"]),
            'cars' => $cars->map(fn($a) => ['key' => $a->id, 'value' => "$a->id. {$a->brand->name} $a->plate {$a->color->name}"])
        ]);
    }

    public function editRental(Request $request): View {

        $fields = $request->validate([
            'id' => 'bail|required|integer',
            'client_id' => 'bail|required|integer',
            'car_id' => 'bail|required|integer',
            'date_start' => 'bail|required|date',
            'duration' => 'bail|required|integer|min:1',
        ]);

        $rental = Rental::find($fields['id']);

        $rental->client_id = $fields['client_id'];
        $rental->car_id = $fields['car_id'];
        $rental->date_start = $fields['date_start'];
        $rental->duration = $fields['duration'];

        $rental->save();

        return $this->rentals();
    }


    // удаление проката
    public function removeRental(int|string $id): View {
        Rental::destroy($id);

        return $this->rentals();
    }

    #endregion


    #region Запросы

    // 1. Запрос на выборку.
    // Выбирает информацию об автомобилях, стоимость одного дня проката которых меньше заданной
    public function query01Form(): View {
        return view('carRentals.queries.query01', [
            'data' => Car::all()
        ]);
    }

    public function query01(Request $request): View {

        $fields = $request->validate([
            'min_rental' => 'bail|required|integer|min:1'
        ]);

        $minRental = $fields['min_rental'];

        $data = Car::where('rental', '>', $minRental)->get();

        return view('carRentals.queries.query01', [
            'min_rental' => $minRental,
            'data' => $data
        ]);
    }


    // 2. Запрос на выборку.
    // Выбирает из таблицы информацию об автомобилях, страховая стоимость которых находится в заданном диапазоне
    public function query02Form(): View {
        return view('carRentals.queries.query02', [
            'data' => Car::all()
        ]);
    }

    public function query02(Request $request): View {

        $fields = $request->validate([
            'min_insurance_pay' => 'bail|required|integer|min:1',
            'max_insurance_pay' => "bail|required|integer|min:{$request->get('min_insurance_pay')}",
        ]);

        $min_insurance_pay = $fields['min_insurance_pay'];
        $max_insurance_pay = $fields['max_insurance_pay'];

        $data = Car::whereBetween('inshurance_pay', [$min_insurance_pay, $max_insurance_pay])->get();

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
            'data' => Rental::all()
        ]);
    }

    public function query03(Request $request): View {

        $fields = $request->validate([
            'passport' => 'bail|required|min:1',
        ]);

        $passport = $fields['passport'];

        $data = Rental::where('passport', 'regexp', '^' . $passport)->get();

        return view('carRentals.queries.query03', [
            'passport' => $passport,
            'data' => $data
        ]);
    }

    // 4. Запрос на выборку.
    // Выбирает их информацию о клиентах, бравших автомобиль напрокат в некоторый определенный день.
    public function query04Form(): View {
        return view('carRentals.queries.query04', [
            'data' => Rental::all()
        ]);
    }

    public function query04(Request $request): View {

        $fields = $request->validate([
            'date_start' => 'required|date',
        ]);

        $dateStart = date_parse($fields['date_start']);
        $dateStart = "{$dateStart['year']}-{$dateStart['month']}-{$dateStart['day']}";

        $data = Rental::where('date_start', '=', $dateStart)->get();

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
            'data' => Car::all()
        ]);
    }

    public function query05(Request $request): View {

        $fields = $request->validate([
            'min_insurance_pay' => 'bail|required|integer|min:1',
            'max_insurance_pay' => "bail|required|integer|min:{$request->get('min_insurance_pay')}",
        ]);

        $min_insurance_pay = $fields['min_insurance_pay'];
        $max_insurance_pay = $fields['max_insurance_pay'];

        $data = Car::whereBetween('inshurance_pay', [$min_insurance_pay, $max_insurance_pay])->get();

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

        $data = Car::orderBy('year_manufacture')->select('*')->selectRaw('inshurance_pay*0.9 as inshurance_pay_value')->get();

        return view('carRentals.queries.query06', [
            'data' => $data
        ]);
    }

    #endregion

}
