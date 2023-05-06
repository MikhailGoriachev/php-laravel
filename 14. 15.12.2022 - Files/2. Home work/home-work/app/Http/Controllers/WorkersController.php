<?php

namespace App\Http\Controllers;

use App\Models\Utils;
use App\Models\Worker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class WorkersController extends Controller {

    // данные
    public array $data;

    // название файла
    const FILE_FULL_NAME = 'workers.json';


    // конструктор
    public function __construct() {
        $data = $this->load();

        if (is_null($data))
            $this->save($data = Utils::getWorkerList());

        $this->data = $data;
    }


    // работники упорядоченные по фамилии и инициалам
    public function allData(): View {
        $data = [...$this->data];
        usort($data, fn($a, $b) => $a->fullName <=> $b->fullName);
        return view('workers.workerList', ['data' => $data]);
    }

    // выделение работников с максимальным окладом
    public function selectByMaxSalary(): View {

        $data = [...$this->data];
        usort($data, fn($a, $b) => $a->position <=> $b->position);

        $maxSalary = !empty($data) ? max(array_map(fn($a) => $a->salary, $data)) : 0;

        return view('workers.workerList', [
            'predicate' => fn($w) => $w->salary === $maxSalary,
            'data' => $data,
            'title' => html_entity_decode("Работники. Максимальный оклад: $maxSalary (&#8381;)")
        ]);
    }

    // выборка работников с минимальным окладом
    public function selectByMinSalary(): View {

        $data = [...$this->data];
        usort($data, fn($a, $b) => $a->fullName <=> $b->fullName);

        $minSalary = !empty($data) ? min(array_map(fn($a) => $a->salary, $data)) : 0;

        return view('workers.workerList', [
            'predicate' => fn($w) => $w->salary === $minSalary,
            'data' => $data,
            'title' => html_entity_decode("Работники. Минимальный оклад: $minSalary (&#8381;)")
        ]);
    }

    // выборка работников с превышением заданного стажа работы
    public function selectByOverExperience(Request $request): View {

        $data = [...$this->data];
        usort($data, fn($a, $b) => $a->salary <=> $b->salary);

        $experience = +($request->get('experience'));

        return view('workers.workerList', [
            'predicate' => fn($w) => $w->getExperience() > $experience,
            'data' => $data,
            'title' => "Работники. Стаж больше: $experience (лет)",
            'experience' => $experience
        ]);
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
        array_unshift($this->data, (new Worker())->setDataFromArray([
            ...$fields,
            'id' => max(array_map(fn($a) => $a->id, $this->data)) + 1,
            'image' => ($fields['gender'] ? 'male' : 'female') . '_00' . random_int(1, 9) . '.jpg'
        ]));

        $this->save($this->data);

        $data = [...$this->data];
        usort($data, fn($a, $b) => $a->fullName <=> $b->fullName);
        return view('workers.workerList', ['data' => $data]);
    }

    // форма для изменения
    public function editForm(string $id): View {

        $worker = $this->data[array_search(+$id, array_map(fn($a) => $a->id, $this->data))];

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

        $this->data[array_search(+$fields['id'], array_map(fn($a) => $a->id, $this->data))]->setDataFromArray($fields);

        $this->save($this->data);

        $data = [...$this->data];
        usort($data, fn($a, $b) => $a->fullName <=> $b->fullName);
        return view('workers.workerList', ['data' => $data]);
    }

    // удаление записи
    public function delete(string $id): view {

        array_splice($this->data, array_search(+$id, array_map(fn($a) => $a->id, $this->data)), 1);

        $this->save($this->data);

        $data = [...$this->data];
        usort($data, fn($a, $b) => $a->fullName <=> $b->fullName);
        return view('workers.workerList', ['data' => $data]);
    }

    // загрузка данных
    public function load(): array|null {
        $disk = Storage::disk('local');

        if (!$disk->exists(WorkersController::FILE_FULL_NAME))
            return null;

        return array_map(fn($d) => (new Worker())->setDataFromArray($d), json_decode($disk->get(WorkersController::FILE_FULL_NAME), true));
    }

    // сохранение данных
    public function save(array $data): void {
        $disk = Storage::disk('local');

        $disk->put(WorkersController::FILE_FULL_NAME, json_encode($data));
    }
}
