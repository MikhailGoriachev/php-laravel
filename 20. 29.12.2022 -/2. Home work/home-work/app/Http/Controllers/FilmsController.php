<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Film;
use App\Models\Genre;
use App\Models\Producer;
use App\Models\Utils;
use Illuminate\Http\File;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Notifications\Action;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class FilmsController extends Controller {

    const DATA_FILE_NAME = 'data.json';

    #region Таблицы

    // фильмы
    public function films(bool $isTitles = false): View {
        return view('films.tables.films', [
            'data' => Film::with(['genre', 'producer', 'country'])->get(),
            'isTitles' => $isTitles
        ]);
    }


    // жанры
    public function genres(): View {
        return view('films.tables.genres', ['data' => Genre::all()]);
    }


    // режиссёры
    public function producers(): View {
        return view('films.tables.producers', [
            'data' => Producer::all(),
            'genreList' => Genre::all()->map(fn($a) => ['key' => $a->id, 'value' => "$a->id. $a->name"]),
            'countryList' => Country::all()->map(fn($a) => ['key' => $a->id, 'value' => "$a->id. $a->name"]),
        ]);
    }


    // страны
    public function countries(): View {
        return view('films.tables.countries', ['data' => Country::all()]);
    }

    #endregion


    #region CRUD

    // добавление режиссёра
    public function addProducerForm(): View {
        return view('films.forms.producerForm', ['isAdd' => true]);
    }

    public function addProducer(Request $request): RedirectResponse {

        $fields = $request->validate([
            'surname' => 'bail|required|string|min:1',
            'name' => 'bail|required|string|min:1',
            'patronymic' => 'nullable',
            'date_of_birth' => 'bail|required|date',
            'file' => 'nullable'
        ]);

        $file = $request->file('file');
        $file->store('public/producers');

        $fields['image'] = $file->hashName();

        $date = date_parse($fields['date_of_birth']);
        $fields['date_of_birth'] = "{$date['year']}-{$date['month']}-{$date['day']}";

        (new Producer($fields))->save();

        return redirect()->action([FilmsController::class, 'producers']);
    }



    // изменение режиссёра
    public function editProducerForm(int|string $id): View {

        return view('films.forms.producerForm', [
            'item' => Producer::find($id),
            'isAdd' => false
        ]);
    }

    public function editProducer(Request $request): RedirectResponse {

        $fields = $request->validate([
            'id' => 'required',
            'surname' => 'bail|required|string|min:1',
            'name' => 'bail|required|string|min:1',
            'patronymic' => 'nullable',
            'date_of_birth' => 'bail|required|date',
            'image' => 'bail|required|string|min:1',
            'file' => 'nullable'
        ]);

        if (isset($fields['file'])) {

            $disc = Storage::disk('local');
            $disc->delete("public/producers/{$fields['image']}");

            $file = $request->file('file');
            $file->store('public/producers');
            $fields['image'] = $file->hashName();
        }

        $date = date_parse($fields['date_of_birth']);
        $fields['date_of_birth'] = "{$date['year']}-{$date['month']}-{$date['day']}";

        $prod = Producer::find($fields['id']);

        $prod->surname = $fields['surname'];
        $prod->name = $fields['name'];
        $prod->patronymic = $fields['patronymic'];
        $prod->date_of_birth = $fields['date_of_birth'];
        $prod->image = $fields['image'];

        $prod->save();

        return redirect()->action([FilmsController::class, 'producers']);
    }


    // добавление фильма
    public function addFilmForm(): View {
        return view('films.forms.filmForm', [
            'producerList' => Producer::all()->map(fn($a) => ['key' => $a->id, 'value' => "$a->id. $a->surname $a->name $a->patronymic"]),
            'genreList' => Genre::all()->map(fn($a) => ['key' => $a->id, 'value' => "$a->id. $a->name"]),
            'countryList' => Country::all()->map(fn($a) => ['key' => $a->id, 'value' => "$a->id. $a->name"]),
            'isAdd' => true
        ]);
    }

    public function addFilm(Request $request): RedirectResponse {

        $fields = $request->validate([
            'name' => 'required',
            'producer_id' => 'bail|required',
            'release_date' => 'bail|required|date',
            'genre_id' => 'bail|required',
            'budget' => 'bail|required',
            'image' => 'nullable',
            'country_id' => 'bail|required',
            'file' => 'required'
        ]);

        $file = $request->file('file');
        $file->store('public/films');

        $fields['image'] = $file->hashName();

        $date = date_parse($fields['release_date']);
        $fields['release_date'] = "{$date['year']}-{$date['month']}-{$date['day']}";

        (new Film($fields))->save();

        return redirect()->action([FilmsController::class, 'films']);
    }


    // изменение фильма
    public function editFilmForm(int|string $id): View {

        return view('films.forms.filmForm', [
            'producerList' => Producer::all()->map(fn($a) => ['key' => $a->id, 'value' => "$a->id. $a->surname $a->name $a->patronymic"]),
            'genreList' => Genre::all()->map(fn($a) => ['key' => $a->id, 'value' => "$a->id. $a->name"]),
            'countryList' => Country::all()->map(fn($a) => ['key' => $a->id, 'value' => "$a->id. $a->name"]),
            'isAdd' => false,
            'item' => Film::find($id)
        ]);
    }

    public function editFilm(Request $request): RedirectResponse {

        $fields = $request->validate([
            'id' => 'required',
            'name' => 'required',
            'producer_id' => 'bail|required|integer|min:0',
            'release_date' => 'bail|required|date',
            'genre_id' => 'bail|required|integer|min:0',
            'budget' => 'bail|required|integer|min:0',
            'image' => 'bail|required|string|min:0',
            'country_id' => 'bail|required|integer|min:0',
            'file' => 'nullable'
        ]);

        if (isset($fields['file'])) {

            $disc = Storage::disk('local');
            $disc->delete("public/films/{$fields['image']}");

            $file = $request->file('file');
            $file->store('public/films');
            $fields['image'] = $file->hashName();
        }

        $date = date_parse($fields['release_date']);
        $fields['release_date'] = "{$date['year']}-{$date['month']}-{$date['day']}";

        $prod = Film::find($fields['id']);

        $prod->name = $fields['name'];
        $prod->producer_id = $fields['producer_id'];
        $prod->release_date = $fields['release_date'];
        $prod->genre_id = $fields['genre_id'];
        $prod->budget = $fields['budget'];
        $prod->image = $fields['image'];
        $prod->country_id = $fields['country_id'];

        $prod->save();

        return redirect()->action([FilmsController::class, 'films']);
    }


    // удаление фильма
    public function removeFilm(int|string $id): RedirectResponse {
        $film = Film::find($id);
        $disc = Storage::disk('local');
        $disc->delete("public/films/{$film['image']}");
        Film::destroy($id);

        return redirect()->action([FilmsController::class, 'films']);
    }

    #endregion


    #region Фильтры

    // фильмы, вышедшие на экран в текущем и прошлом году
    public function filmsByCurrentAndLastYear(): View {
        $curYear = +date('Y');

        return view('films.tables.films', [
            'data' => Film::with(['genre', 'producer', 'country'])
                ->get()
                ->where(fn($f) => ($date = date_parse($f->release_date)['year']) === ($curYear - 1) || $date === $curYear)
        ]);
    }


    // фильмы, дата выхода которых была более заданного числа лет назад
    public function filmsByOverYearsLast(Request $request): View {
        $years = $request->validate(['years' => 'bail|required|integer|min:1'])['years'];

        $curYear = +date('Y');

        return view('films.tables.films', [
            'data' => Film::with(['genre', 'producer', 'country'])
                ->get()
                ->where(fn($f) => ($curYear - date_parse($f->release_date)['year']) > $years),
            'years' => $years
        ]);
    }


    // режиссеры, снимавшие фильмы заданного жанра
    public function producersByGenre(Request $request): View {
        $genre_id = +$request->validate(['genre_id' => 'bail|required|integer|min:1'])['genre_id'];

        return view('films.tables.producers', [
            'data' => Producer::with(['films'])->get()
                ->where(fn($p) => $p->films->some(fn($f) => $f->genre_id === $genre_id)),
            'genreList' => Genre::all()->map(fn($a) => ['key' => $a->id, 'value' => "$a->id. $a->name"]),
            'countryList' => Country::all()->map(fn($a) => ['key' => $a->id, 'value' => "$a->id. $a->name"]),
            'genre_id' => $genre_id
        ]);
    }


    // режиссеры из заданной страны
    public function producersByCountry(Request $request): View {
        $country_id = +$request->validate(['country_id' => 'bail|required|integer|min:1'])['country_id'];

        return view('films.tables.producers', [
            'data' => Producer::all()
                ->where(fn($p) => $p->films->some(fn($f) => $f->country_id === $country_id)),
            'genreList' => Genre::all()->map(fn($a) => ['key' => $a->id, 'value' => "$a->id. $a->name"]),
            'countryList' => Country::all()->map(fn($a) => ['key' => $a->id, 'value' => "$a->id. $a->name"]),
            'country_id' => $country_id
        ]);
    }

    #endregion

    // скачать данных данные
    public function downloadData() {
        $this->saveDataToJson(self::DATA_FILE_NAME);

        return Storage::download(self::DATA_FILE_NAME);
    }

    // сохранение в JSON данных из всех таблиц
    public function saveDataToJson(string $fileName): void {
        $disc = Storage::disk('local');

        $json = collect([
            'genres' => Genre::all()->toJson(),
            'producers' => Producer::all()->toJson(),
            'countries' => Country::all()->toJson(),
            'films' => Film::all()->toJson()
        ])->toJson();

        $disc->put($fileName, $json);
    }


    // загрузка данных
    public function uploadDataForm() : View {
        return view('films.forms.uploadDataForm');
    }

    public function uploadData(Request $request) : RedirectResponse {

        $file = $request->validate(['file' => 'required'])['file'];

        $request->file('file')->storeAs('', self::DATA_FILE_NAME);

        $this->loadDataToJson();

        return redirect('tables/films/true');
    }

    // загрузка очистка данных из таблиц и загрузка в них данных из JSON
    public function loadDataToJson(): void {
        $disc = Storage::disk('local');

        DB::statement('set foreign_key_checks=0');

        Film::truncate();
        Country::truncate();
        Producer::truncate();
        Genre::truncate();

        DB::statement('set foreign_key_checks=1');


        $data = json_decode($disc->get('data.json'));

        collect(json_decode($data->genres))->map(fn($a) => (new Genre(collect($a)->all()))->save());
        collect(json_decode($data->producers))->map(fn($a) => (new Producer(collect($a)->all()))->save());
        collect(json_decode($data->countries))->map(fn($a) => (new Country(collect($a)->all()))->save());
        collect(json_decode($data->films))->map(fn($a) => (new Film(collect($a)->all()))->save());
    }
}
