<?php

namespace Models\Task03;

use Infrastructure\Utils;
use Models\Task01\Goods;

// Класс Список планет
class PlanetList {
    const FILE_NAME = 'planets.csv';
    const DIR_NAME = '../App_Data';

    // исходная коллекция
    private array $source;

    // коллекция планет
    private array $list;

    public function getList(): array {
        return $this->list;
    }


    // конструктор
    public function __construct() {
        if (!$this->load()) {

            // типы планет
            $types = Utils::getTypesPlanet();

            $this->save([
                new Planet(1, "Меркурий", 2_439.7, $types[0], 3.304e23, 0, 0.39, "mercury.png"),
                new Planet(2, "Венера", 6_051.8, $types[0], 4.872e24, 0, 0.72, "venera.jpg"),
                new Planet(3, "Земля", 6_371, $types[0], 5.978e24, 1, 1.0, "earth.jpg"),
                new Planet(4, "Марс", 3_389.5, $types[0], 6.423e24, 2, 1.52, "mars.jpg"),
                new Planet(5, "Юпитер", 69_911, $types[1], 1.900e23, 16, 5.2, "upiter.jpg"),
                new Planet(6, "Сатурн", 58_232, $types[1], 5.689e26, 30, 9.54, "saturn.png"),
                new Planet(7, "Уран", 25_362, $types[2], 8.72e25, 15, 19.19, "uran.jpg"),
                new Planet(8, "Нептун", 24_622, $types[2], 1.03e26, 6, 30.07, "neptun.jpg"),
            ]);

            $this->load();
        }
    }


    // удалить элемент
    public function removeItem(int|null $id): void {
        if ($id === null)
            return;

        unset($this->source[key(array_filter($this->source, fn($g) => $g->getId() === $id))]);

        $this->list = [...$this->source = array_values($this->source)];

        $this->save($this->source);
    }

    // получить запись по id
    function getItemById(int $id): Goods {
        return $this->list[key(array_filter($this->list, fn($g) => $g->getId() === $id))];
    }

    // вывод в таблицу
    function toTableHTML(): string {

        $html = '
        <form method="post">
        <table class="table table-striped">
        <thead>
            <tr>
                <th><button type="submit" class="btn btn-link" name="orderName" value="default">№</button></th>
                <th>Изображение</th>
                <th><button type="submit" class="btn btn-link" name="orderName" value="name">Название</button></th>
                <th>Тип планеты</th>
                <th>Радиус</th>
                <th><button type="submit" class="btn btn-link" name="orderName" value="mass">Масса</button></th>
                <th>Спутники</th>
                <th><button type="submit" class="btn btn-link" name="orderName" value="distance">Расстояние до Солнца</button></th>
                <th></th>
            </tr>
        </thead>

        <tbody class="align-middle">
        ';

        $html .= array_reduce($this->list,
            fn($p, $c) => $p .
                          '<tr>' .
                          '<td>' . $c->getId() . '</td>' .
                          "<td><img class='h-7rem' src='/images/planets/{$c->getImage()}' alt='image'/></td>" .
                          "<td>{$c->getName()}</td>" .
                          "<td>{$c->getType()}</td>" .
                          '<td>' . sprintf('%.3E', $c->getRadius()) . '</td>' .
                          '<td>' . sprintf('%.3E', $c->getMass()) . '</td>' .
                          "<td>{$c->getAmountSatellites()}</td>" .
                          "<td>{$c->getDistance()}</td>" .
                          "<td>
                        <form class='d-inline' method='post'>
                            <button class='btn btn-outline-danger' type='submit' name='remove' value='{$c->getId()}'
                                    title='Удалить'>
                                <i class='bi bi-trash-fill'></i>
                            </button>
                        </form>
                           </td>" .
                          '</tr>'
            , '');

        $html .= '</tbody></table></form>';

        return $html;
    }

    // упорядочивание по умолчанию (исхолдная коллекция)
    function orderByDefault(): void {
        $this->list = $this->source;
    }

    // упорядочивание по расстоянию
    function orderByDistance(): void {
        usort($this->list, fn($a, $b) => $a->getDistance() <=> $b->getDistance());
    }

    // упорядочивание по алфавиту
    function orderByName(): void {
        usort($this->list, fn($a, $b) => $a->getName() <=> $b->getName());
    }

    // упорядочивание по массе
    function orderByMass(): void {
        usort($this->list, fn($a, $b) => $a->getMass() <=> $b->getMass());
    }
    
    // выборка планет по умолчанию (все записи)
    public function selectByDefault(): void {
        $this->list = $this->source;
    }
    
    // выборка планет по массе
    public function selectByMass(float $min, float $max): void {
        $this->list = array_filter($this->source, fn($p) => $p->getMass() >= $min && $p->getMass() <= $max);
    }
    
    // выборка планет по типу
    public function selectByType(string $type): void {
        $this->list = array_filter($this->source, fn($p) => $p->getType() === $type);
    }

    // установить значения из массива
    function setDataFromArray(array $arr): void {
        $this->source = [...$this->list = array_map(fn($item) => new Planet(...$item), $arr)];
    }

    // запись данных в файл в формте CSV
    function save(array $arr): void {
        date_default_timezone_set('UTC');

        Utils::checkOrCreateFile(self::DIR_NAME, self::FILE_NAME);

        $file = fopen(self::DIR_NAME . '/' . self::FILE_NAME, 'w');

        array_walk($arr, fn($a) => fputcsv($file, $a->getArrayValues()));
        fclose($file);
    }

    // загрузить данные из файла в формте CSV
    function load(): bool {
        $path = self::DIR_NAME . '/' . self::FILE_NAME;

        if (!file_exists(self::DIR_NAME . '/' . self::FILE_NAME))
            return false;

        $file = fopen($path, 'r');

        $result = [];

        while (!feof($file)) {
            $buf = fgetcsv($file);

            if (is_array($buf))
                $result[] = $buf;
        }

        fclose($file);

        $this->setDataFromArray($result);

        return true;
    }
}