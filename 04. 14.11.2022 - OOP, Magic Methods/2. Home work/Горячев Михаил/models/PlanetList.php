<?php

require_once "Planet.php";
require_once "../infrastructure/utils.php";

// Класс Список планет
class PlanetList
{
    const FILE_NAME = 'planets.csv';
    const DIR_NAME = '../App_Data';

    // исходная коллекция
    private array $source;

    // коллекция планет
    private array $list;

    public function getList(): array
    {
        return $this->list;
    }


    // конструктор
    public function __construct()
    {
        if (!$this->load()) {
            $this->save([
                new Planet("Меркурий", 2_439.7, 3.304e23, 0, 0.39, "mercury.png"),
                new Planet("Венера", 6_051.8, 4.872e24, 0, 0.72, "venera.jpg"),
                new Planet("Земля", 6_371, 5.978e24, 1, 1.0, "earth.jpg"),
                new Planet("Марс", 3_389.5, 6.423e24, 2, 1.52, "mars.jpg"),
                new Planet("Юпитер", 69_911, 1.900e23, 16, 5.2, "upiter.jpg"),
                new Planet("Сатурн", 58_232, 5.689e26, 30, 9.54, "saturn.png"),
                new Planet("Уран", 25_362, 8.72e25, 15, 19.19, "uran.jpg"),
                new Planet("Нептун", 24_622, 1.03e26, 6, 30.07, "neptun.jpg"),
            ]);

            $this->load();
        }
    }


    // вывод в таблицу
    function toTableHTML(): string
    {

        $html = '
        <form method="post">
        <table class="table table-striped">
        <thead>
            <tr>
                <th><button type="submit" class="btn btn-link" name="orderBy" value="default">№</button></th>
                <th>Изображение</th>
                <th><button type="submit" class="btn btn-link" name="orderBy" value="name">Название</button></th>
                <th>Радиус</th>
                <th><button type="submit" class="btn btn-link" name="orderBy" value="mass">Масса</button></th>
                <th>Спутники</th>
                <th><button type="submit" class="btn btn-link" name="orderBy" value="distance">Расстояние до Солнца</button></th>
            </tr>
        </thead>

        <tbody class="align-middle">
        ';

        $html .= array_reduce($this->list, function ($p, $c) {
            static $n = 1;
            return $p .
                '<tr>' .
                '<td>' . $n++ . '</td>' .
                "<td><img class='h-7rem' src='/images/planets/{$c->getImage()}' alt='image'/></td>" .
                "<td>{$c->getName()}</td>" .
                '<td>' . sprintf('%.3E', $c->getRadius()) . '</td>' .
                '<td>' . sprintf('%.3E', $c->getMass()) . '</td>' .
                "<td>{$c->getAmountSatellites()}</td>" .
                "<td>{$c->getDistance()}</td>" .
                '</tr>';
        }
            , '');

        $html .= '</tbody></table></form>';

        return $html;
    }

    // упорядочивание по умолчанию (исхолдная коллекция)
    function orderByDefault(): void
    {
        $this->list = $this->source;
    }

    // упорядочивание по расстоянию
    function orderByDistance(): void
    {
        usort($this->list, fn($a, $b) => $a->getDistance() <=> $b->getDistance());
    }

    // упорядочивание по алфавиту
    function orderByName(): void
    {
        usort($this->list, fn($a, $b) => $a->getName() <=> $b->getName());
    }

    // упорядочивание по массе
    function orderByMass(): void
    {
        usort($this->list, fn($a, $b) => $a->getMass() <=> $b->getMass());
    }

    // установить значения из массива
    function setDataFromArray(array $arr): void
    {
        $this->source = $this->list = array_map(fn($item) => new Planet(...$item), $arr);
    }

    // запись данных в файл в формте CSV
    function save(array $arr): void
    {
        date_default_timezone_set('UTC');

        checkOrCreateFile(self::DIR_NAME, self::FILE_NAME);

        $file = fopen(self::DIR_NAME . '/' . self::FILE_NAME, 'w');

        array_walk($arr, fn($a) => fputcsv($file, $a->getArrayValues()));
        fclose($file);
    }

    // загрузить данные из файла в формте CSV
    function load(): bool
    {
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