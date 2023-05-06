<?php

namespace App\Task01;

// Вариант 12. Найти номер первой из строк, содержащих хотя бы один положительный элемент (0 считаем положительным
// числом). Уплотнить заданную матрицу, удаляя из нее строки и столбцы, заполненные нулями.
class Variant12 {

    // использование трейта
    use MatrixTrait;

    // работа по заданию
    public function run(): array {
        
        $rowsCount = count($this->matrix);
        $colsCount = isset($this->matrix[0]) ? count($this->matrix[0]) : 0;

        $firstNullRow = null;

        $result = [];

        $result['nullRows'] = [];
        $result['nullCols'] = [];

        // поиск нулевых строк
        for ($i = 0; $i < $rowsCount; $i++) {
            $row = $this->matrix[$i];

            // поиск первой строки с нулём
            $firstNullRow = is_null($firstNullRow) ? !in_array(0, $row) ?: $i : $firstNullRow;

            // количество нулей в строке 
            $amountNullInRow = array_reduce($row, fn($p, $c) => $p + ($c === 0 ? 1 : 0));

            if ($amountNullInRow === $colsCount)
                $result['nullRows'][] = $i;
        }

        // поиск нулевых столбцов
        for ($i = 0; $i < $colsCount; $i++) {
            $col = array_column($this->matrix, $i);

            // количество нулей в столбце
            $amountNullInCol = array_reduce($col, fn($prev, $cur) => $prev + ($cur === 0 ? 1 : 0));

            if ($amountNullInCol === $rowsCount)
                $result['nullCols'][] = $i;
        }

        // первая строка включающая нулевое значение
        $result['firstNullRow'] = $firstNullRow;   

        // удаление столбцов
        $count = count($result['nullCols']);
        for ($i = 0; $i < $count; $i++) {
            for ($k = 0; $k < $rowsCount; $k++)
                unset($this->matrix[$k][$result['nullCols'][$i]]);
        }

        // удаление строк
        $count = count($result['nullRows']);
        for ($i = 0; $i < $count; $i++)
            unset($this->matrix[$result['nullRows'][$i]]);
        
        // перегруппировка массива, после удаления элементов 
        $this->matrix = array_values($this->matrix);
        array_walk($this->matrix, fn(&$r) => $r = array_values($r));
        
        return $result;
    }
}