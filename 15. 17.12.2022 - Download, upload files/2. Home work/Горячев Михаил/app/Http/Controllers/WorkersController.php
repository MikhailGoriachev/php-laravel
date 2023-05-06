<?php

namespace App\Http\Controllers;

use App\Models\Utils;
use App\Models\Worker;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class WorkersController extends Controller {

    // данные
    public Collection $data;

    // название файла
    const FILE_FULL_NAME = 'workers.json';

    // название файла с временными данными
    const TEMP_FILE_FULL_NAME = 'tempData.txt';


    // конструктор
    public function __construct() {
        $data = $this->load();

        if (is_null($data))
            $this->save($data = collect(Utils::getWorkerList()));

        $this->data = $data;
    }


    // работники упорядоченные по фамилии и инициалам
    public function allData(): View {
        $data = $this->data->sortBy('fullName');

        return view('workers.workerList', ['data' => $data->all()]);
    }

    // выделение работников с максимальным окладом
    public function selectByMaxSalary(): View {

        $data = $this->data->sortBy('position');

        $maxSalary = $data->max('salary') ?? 0;

        $this->saveTableToFile(
            $data->filter(fn($w) => $w->salary === $maxSalary),
            self::TEMP_FILE_FULL_NAME,
            'Работники с максимальным окладом'
        );

        return view('workers.workerList', [
            'predicate' => fn($w) => $w->salary === $maxSalary,
            'data' => $data->all(),
            'title' => html_entity_decode("Работники. Максимальный оклад: $maxSalary (&#8381;)"),
            'isDownloadFile' => true
        ]);
    }

    // выборка работников с минимальным окладом
    public function selectByMinSalary(): View {

        $data = $this->data->sortBy('fullName');
        $minSalary = $data->min('salary') ?? 0;

        $this->saveTableToFile(
            $data->filter(fn($w) => $w->salary === $minSalary),
            self::TEMP_FILE_FULL_NAME,
            'Работники с минимальным окладом'
        );

        return view('workers.workerList', [
            'predicate' => fn($w) => $w->salary === $minSalary,
            'data' => $data,
            'title' => html_entity_decode("Работники. Минимальный оклад: $minSalary (&#8381;)"),
            'isDownloadFile' => true
        ]);
    }

    // выборка работников с превышением заданного стажа работы
    public function selectByOverExperience(Request $request): View {

        $data = $this->data->sortBy('salary');

        $experience = +($request->get('experience'));

        $this->saveTableToFile(
            $data->filter(fn($w) => $w->getExperience() > $experience),
            self::TEMP_FILE_FULL_NAME,
            "Работники со стажем больше $experience (лет)"
        );

        return view('workers.workerList', [
            'predicate' => fn($w) => $w->getExperience() > $experience,
            'data' => $data,
            'title' => "Работники. Стаж больше: $experience (лет)",
            'experience' => $experience,
            'isDownloadFile' => true
        ]);
    }

    // загрузка файла с данных выборки
    public function downloadSelectionFileData() {
        $disk = Storage::disk('local');

        $disk->exists(self::TEMP_FILE_FULL_NAME);

        return Storage::download(self::TEMP_FILE_FULL_NAME, 'data.txt');
    }

    // форма для добавления
    public function addForm(): View {
        return view('workers.workerForm', [
            'isAdd' => true,
            'positionList' => Utils::getPositionList()
        ]);
    }

    // добавление записи
    public function add(Request $request): View {
        $fields = $request->all();

        $file = $request->file('photo');

        $file->store('public/people');
        $fields['image'] = $file->hashName();

        $this->data->prepend((new Worker())->setDataFromArray([
            ...$fields,
            'id' => ($this->data->isEmpty() ? 1 : $this->data->max('id') + 1),
        ]));

        $this->save($this->data);

        return $this->allData();
    }

    // форма для изменения
    public function editForm(string $id): View {

        $worker = $this->data->firstWhere('id', +$id);

        return view('workers.workerForm', [
            'isAdd' => false,
            'id' => $worker->id,
            'fullName' => $worker->fullName,
            'position' => $worker->position,
            'gender' => $worker->gender,
            'yearOfEmployment' => $worker->yearOfEmployment,
            'salary' => $worker->salary,

            'positionList' => Utils::getPositionList()
        ]);
    }

    // изменение записи
    public function edit(Request $request): View {
        $fields = $request->all();

        if ($request->file('photo') !== null) {
            $file = $request->file('photo');

            $file->store('public/people');
            $fields['image'] = $file->hashName();
        }

        $this->data->firstWhere('id', +$fields['id'])->setDataFromArray($fields);

        $this->save($this->data);

        return $this->allData();
    }

    // удаление записи
    public function delete(string $id): view {

        $this->data = $this->data->reject(fn($a) => $a->id === +$id);

        $this->save($this->data);

        return $this->allData();
    }

    // запись данных в файл в табличном формате
    public function saveTableToFile(Collection $data, string $fileName, string $title) {
        $disk = Storage::disk('local');

        $header = " ╔═════════════════════════════════════════════════════════════════════════════════════════════════════╦═══════════════╗\n" .
                  " ║ " . Str::padRight($title, 99) . sprintf(' ║ Записей: %4d', $data->count()) . " ║\n" .
                  " ╠════╦══════════════════════╦══════════════════════╦════════════╦═══════╦══════╦══════════════════════╬═══════════════╣\n" .
                  " ║ id ║  Фамилия и инициалы  ║      Должность       ║    Пол     ║  Год  ║ Опыт ║      Фотография      ║     Оклад     ║\n" .
                  " ╠════╬══════════════════════╬══════════════════════╬════════════╬═══════╬══════╬══════════════════════╬═══════════════╣\n";

        $footer = " ╚════╩══════════════════════╩══════════════════════╩════════════╩═══════╩══════╩══════════════════════╩═══════════════╝";

        $disk->put($fileName, $header . $data->reduce(
                fn($p, $c) => $p .
                              sprintf(' ║ %2d ║ ', $c->id) .
                              Str::padRight($c->fullName, 20) . ' ║ ' .
                              Str::padRight($c->position, 20) . ' ║ ' .
                              Str::padRight($c->gender ? 'мужской' : 'женский', 10) . ' ║ ' .
                              sprintf('%5d ║ ', $c->yearOfEmployment) .
                              sprintf('%4d ║ ', $c->getExperience()) .
                              Str::padRight($c->image, 20) . ' ║ ' .
                              sprintf("%13.2f ║\n", $c->salary)
                , '')
                              . $footer);
    }

    // загрузка данных
    public function load(): Collection|null {
        $disk = Storage::disk('local');

        if (!$disk->exists(WorkersController::FILE_FULL_NAME))
            return null;

        return collect(
            json_decode($disk->get(WorkersController::FILE_FULL_NAME), true))
            ->map(fn($a) => (new Worker())->setDataFromArray($a)
            );
    }

    // сохранение данных
    public function save(Collection $data): void {
        $disk = Storage::disk('local');

        $disk->put(WorkersController::FILE_FULL_NAME, $data->toJson());
    }
}
