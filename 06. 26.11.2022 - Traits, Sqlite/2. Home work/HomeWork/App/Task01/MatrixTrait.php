<?php

namespace App\Task01;

trait MatrixTrait {

    // матрица
    public array $matrix;

    // минимальное значение 
    public int $minValue;

    // максимальное значение
    public int $maxValue;


    // контруктор
    public function __construct($minValue, $maxValue, $rows, $cols) {
        $this->minValue = $minValue;
        $this->maxValue = $maxValue;
        $this->create($rows, $cols);
    }

    // создание матрицы
    public function create($rows, $cols): void {
        $this->matrix = array_map(fn($r) => $r = array_pad([], $cols, 0), array_pad([], $rows, 0));
    }

    // заполнение матрицы
    public function fill(): void {
        $this->matrix = array_map(fn($r) => array_map(fn($c) => random_int($this->minValue, $this->maxValue), $r), $this->matrix);
    }

    // вывод матрицы
    function showArray(string $title, $isActive = null, array $rightCol = null,
        array $bottomRow = null, string $content = ''): void {
        $isActive = $isActive ?: fn() => "";

        $html = '';

        $rows = count($this->matrix);
        $cols = isset($this->matrix[0]) ? count($this->matrix[0]) : 0;

        for ($i = 0; $i < $rows; $i++) {
            $html .= '<div class="row">';
            for ($k = 0; $k < $cols; $k++) {
                $val = $this->matrix[$i][$k];
                $html .= "<div class='border m-2 p-2 shadow-sm col text-center rounded {$isActive($val)}'>$val</div>";
            }
            if ($rightCol)
                $html .= "<div class='border m-2 p-2 shadow-sm col text-center rounded bg-light-green'>$rightCol[$i]</div>";
            $html .= '</div>';
        }

        if ($bottomRow) {
            $html .= '<div class="row">' .
                     array_reduce($bottomRow, fn($prev, $a) => $prev . "<div class='border m-2 p-2 shadow-sm col text-center rounded bg-light-green'>$a</div>")
                     . '</div>';
        }

        if (count($this->matrix) <= 0)
            $html = "<h4>Нет данных</h4>";

        echo "<div class='m-3 p-3 border shadow rounded'><h5 class='text-center'>$title</h5>$html$content</div>";
    }

}