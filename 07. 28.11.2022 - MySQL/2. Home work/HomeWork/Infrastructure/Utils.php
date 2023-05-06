<?php

namespace Infrastructure;

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

//        array_walk($data, fn($d) => fputcsv($file, $d));
        array_walk($data, fn($d) => fputcsv($file, $d));

//        fputcsv($file, $data);
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
        return $arr[random_int(0, count($arr))];
    }
}
