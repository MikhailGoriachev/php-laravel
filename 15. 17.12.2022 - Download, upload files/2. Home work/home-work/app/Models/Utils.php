<?php

namespace App\Models;

// Утилиты
class Utils {

    // генерация вещественного числа
    static function random_float(float $min = -10, float $max = 10): float {
        return random_int($min, $max) + (mt_rand() / mt_getrandmax());
    }

    // проверить наличие файла или создать файл
    static function checkOrCreateFile(string $dirName, string $fileName): void {
        if (!file_exists($dirName))
            mkdir($dirName);

        $file = fopen($dirName . '/' . $fileName, 'a');
        fclose($file);
    }

    // запись данных в файл в формате csv
    static function saveToCsv(string $dirName, string $fileName, array $data): void {
        if (!file_exists($dirName))
            mkdir($dirName);

        $file = fopen($dirName . '/' . $fileName, 'w');

        array_walk($data, fn($d) => fputcsv($file, $d));

        fclose($file);
    }

    // получить данные из файла формата csv
    static function loadFromCsv(string $pathFile): array|null {
        if (!file_exists($pathFile))
            return null;

        $file = fopen($pathFile, 'r');

        $data = [];

        while (!feof($file)) {
            $buf = fgetcsv($file);

            if (is_array($buf))
                $data[] = $buf;
        }

        fclose($file);

        return $data;
    }

    // получить случайный элемент массива
    static function getItem(array $arr) {
        return $arr[random_int(0, count($arr) - 1)];
    }

    // список должностей
    static function getPositionList(): array {
        return [
            'инженер',
            'директор',
            'заведующий',
            'диспетчер',
        ];
    }

    // список картинок
    static function getImageList(): array {
        return [
            'female_001.png',
            'female_002.png',
            'female_003.png',
            'female_004.png',
            'female_005.png',
            'female_006.png',
            'female_007.png',
            'female_008.png',
            'female_009.png',
            'female_010.png',
            'male_001.png',
            'male_002.png',
            'male_003.png',
            'male_004.png',
            'male_005.png',
            'male_006.png',
            'male_007.png',
            'male_008.png',
            'male_009.png',
            'male_010.png'
        ];
    }

    // список сотрудников
    static function getWorkerList(): array {

        $positions = Utils::getPositionList();

        $data = [
            new Worker(1, 'Зверева К. Ф.', Utils::getItem($positions), false, random_int(15, 22) + 2000, 'female_001.jpg', random_int(15, 40) * 1000),
            new Worker(2, 'Кондратьева Е. А.', Utils::getItem($positions), false, random_int(15, 22) + 2000, 'female_002.jpg', random_int(15, 40) * 1000),
            new Worker(3, 'Фадеева С. А.', Utils::getItem($positions), false, random_int(15, 22) + 2000, 'female_003.jpg', random_int(15, 40) * 1000),
            new Worker(4, 'Грачева Д. Н.', Utils::getItem($positions), false, random_int(15, 22) + 2000, 'female_004.jpg', random_int(15, 40) * 1000),
            new Worker(5, 'Федорова М. С.', Utils::getItem($positions), false, random_int(15, 22) + 2000, 'female_005.jpg', random_int(15, 40) * 1000),
            new Worker(6, 'Герасимова К. Е.', Utils::getItem($positions), false, random_int(15, 22) + 2000, 'female_006.jpg', random_int(15, 40) * 1000),
            new Worker(7, 'Краснова А. Г.', Utils::getItem($positions), false, random_int(15, 22) + 2000, 'female_007.jpg', random_int(15, 40) * 1000),
            new Worker(8, 'Кузнецова М. М.', Utils::getItem($positions), false, random_int(15, 22) + 2000, 'female_008.jpg', random_int(15, 40) * 1000),
            new Worker(9, 'Малышева Н. А.', Utils::getItem($positions), false, random_int(15, 22) + 2000, 'female_009.jpg', random_int(15, 40) * 1000),
            new Worker(10, 'Евдокимова В. А.', Utils::getItem($positions), false, random_int(15, 22) + 2000, 'female_010.jpg', random_int(15, 40) * 1000),
            new Worker(11, 'Малинин С. Я.', Utils::getItem($positions), true, random_int(15, 22) + 2000, 'male_001.jpg', random_int(15, 40) * 1000),
            new Worker(12, 'Григорьев Я. С.', Utils::getItem($positions), true, random_int(15, 22) + 2000, 'male_002.jpg', random_int(15, 40) * 1000),
            new Worker(13, 'Федоров Д. К.', Utils::getItem($positions), true, random_int(15, 22) + 2000, 'male_003.jpg', random_int(15, 40) * 1000),
            new Worker(14, 'Волков Г. Б.', Utils::getItem($positions), true, random_int(15, 22) + 2000, 'male_004.jpg', random_int(15, 40) * 1000),
            new Worker(15, 'Андреев А. Г.', Utils::getItem($positions), true, random_int(15, 22) + 2000, 'male_005.jpg', random_int(15, 40) * 1000),
            new Worker(16, 'Ткачев К. А.', Utils::getItem($positions), true, random_int(15, 22) + 2000, 'male_006.jpg', random_int(15, 40) * 1000),
            new Worker(17, 'Никифоров Ф. В.', Utils::getItem($positions), true, random_int(15, 22) + 2000, 'male_007.jpg', random_int(15, 40) * 1000),
            new Worker(18, 'Кузнецов М. М.', Utils::getItem($positions), true, random_int(15, 22) + 2000, 'male_008.jpg', random_int(15, 40) * 1000),
            new Worker(19, 'Колесников В. К.', Utils::getItem($positions), true, random_int(15, 22) + 2000, 'male_009.jpg', random_int(15, 40) * 1000),
            new Worker(20, 'Алексеев Я. Ф.', Utils::getItem($positions), true, random_int(15, 22) + 2000, 'male_010.jpg', random_int(15, 40) * 1000),
        ];

        shuffle($data);

        return $data;
    }
}
