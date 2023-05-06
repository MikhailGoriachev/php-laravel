<?php

namespace App\Task01;

// Вариант 15. Определить номер первого из столбцов, содержащих хотя бы один нулевой элемент. Определить количество
// столбцов, содержащих хотя бы один нулевой элемент. Характеристикой строки целочисленной матрицы назовем сумму ее
// отрицательных четных элементов. Переставляя строки заданной матрицы, расположить их в соответствии с убыванием
// характеристик.
class Variant15 {

    // использование трейта
    use MatrixTrait;

    // получить количество столбцов содержащих хотя бы один элемент с нулевым значением
    public function getCountColsNullValue(): int {
        $result = 0;

        $colsCount = isset($this->matrix[0]) ? count($this->matrix[0]) : 0;
        
        for ($i = 0; $i < $colsCount; $i++)
            $result += in_array(0, array_column($this->matrix, $i));
        
        return $result;
    }
    
    // получить характеристику
    public function getState(): array {
        $rowsCount = count($this->matrix);
        $colsCount = isset($this->matrix[0]) ? count($this->matrix[0]) : 0;
        
        $result = [];
        
        for ($i = 0; $i < $rowsCount; $i++) {
            $row = $this->matrix[$i];
            $sum = 0;
            
            for ($k = 0; $k < $colsCount; $k++)
                $sum += ($k & 1) === 0 && $row[$k] < 0 ? $row[$k] : 0;
            
            $result[$i] = $sum;
        }
        
        return $result;
    }

    // работа по заданию
    public function run(): array {
        $rowsCount = count($this->matrix);
        $colsCount = isset($this->matrix[0]) ? count($this->matrix[0]) : 0;

        $firstNullCol = null;

        for ($i = 0; $i < $colsCount && is_null($firstNullCol); $i++)
            $firstNullCol = in_array(0, array_column($this->matrix, $i)) ? $i : null;

        $result = ['firstNullCol' => $firstNullCol];
        
        // массив характеристик
        $array = $this->getState();

        // перебираем массив
        for ($j = 0; $j < $rowsCount; $j++) {
            for ($i = 0; $i < $rowsCount - $j - 1; $i++) {
                // если текущий элемент больше следующего
                if ($array[$i] < $array[$i + 1]) {

                    [$this->matrix[$i], $this->matrix[$i + 1], $array[$i], $array[$i + 1]] =
                        [$this->matrix[$i + 1], $this->matrix[$i], $array[$i + 1], $array[$i]];
                }
            }
        }

        return $result;
    }
}