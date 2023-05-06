<?php

namespace App\Http\Controllers;

use App\Models\Utils;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CalculateController extends Controller {

    // количество чисел для variant13
    const N_VARIANT13 = 5;

    // размер массива для array17
    const N_ARRAY17 = 12;

    // выражения
    public function variant13(): View {

        $result = [];

        for ($i = 0; $i < self::N_VARIANT13; $i++) {

            [$a, $b] = [Utils::random_float(2, 5), Utils::random_float(2, 5)];

            $temp = 2 * $b - $a;

            [$z1, $z2] = [(sin($a) + cos($temp)) / (cos($a) - sin($temp)), ((1 + sin(2 * $b)) / (cos(2 * $b)))];

            $result[] = ['n' => $i + 1, 'a' => $a, 'b' => $b, 'z1' => $z1, 'z2' => $z2];
        }


        return view('calculate/variant13', ['activeTab' => 'variant13', 'arr' => $result]);
    }

    // массивы
    public function array17(): View {

        $zeroCount = random_int(2, 5);

        $sourceArray = [
            ...array_map(fn() => Utils::random_float(-50, 50), array_pad([], self::N_ARRAY17 - $zeroCount, 0)),
            ...$zeroCount > 0 ? array_fill(0, $zeroCount, 0) : []
        ];

        shuffle($sourceArray);

        // функция вывода массива
        $showArrayFn = function (array &$array, string $title, $isActive = null): void {
            $isActive = $isActive ?: fn() => "";

            $html = array_reduce($array,
                fn($prev, $a) => $prev . sprintf(
                        "<div class='border mx-2 p-2 shadow-sm col text-center rounded  {$isActive($a)}'>%.3f</div>", $a),
                ''
            );

            if (count($array) <= 0)
                $html = "<h4>Нет данных</h4>";

            echo "<div class='m-3 p-3 border bg-white shadow rounded'><h5>$title</h5><div class='row mt-3'>" . $html . '</div></div>';
        };

        // определите количество положительных элементов массива
        $countPositiveItems = array_reduce($sourceArray, fn($p, $c) => $p + ($c > 0 ? 1 : 0), 0);

        // вычислите сумму элементов массива, расположенных после последнего элемента, равного нулю
        $nullLastIndex = array_search(0, $sourceArray);
        $sumItemsAfterLastZeroElem = array_sum(array_slice($sourceArray,  $nullLastIndex + 1));

        // преобразуйте массив таким образом, чтобы сначала располагались все элементы,
        // равные нулю, а потом — все остальные
        $sortArray = [...$sourceArray];
        usort($sortArray, fn($a, $b) => ($b === 0) <=> ($a === 0));

        return view('calculate/array17', [
            'activeTab' => 'array17',
            'showArrayFn' => $showArrayFn,
            'sourceArray' => $sourceArray,
            'countPositiveItems' => $countPositiveItems,
            'sumItemsAfterLastZeroElem' => $sumItemsAfterLastZeroElem,
            'sortArray' => $sortArray
        ]);
    }

    // текст
    public function text7(): View {

        $str = Utils::getItem([
            'Купила бабуся бусы Марусе',
            'На дворе трава, на траве дрова, не руби дрова на траве двора',
            'Все скороговорки в мире не выговорить и не выскороговорить',
            'Макару в карман комарик попал',
            'Сеня вёз воз сена',
            'Всем сорока сорок раз',
            'Если «если» перед «после», значит «после» после «если».',
            'В поле полет Фрося просо',
            'Себе сапоги сыромятные сшила',
            'Семь суток сорока старалась, спешила'
        ]);

        // количество слов из четырёх букв
        $amountWordsFourLetters = preg_match_all('/\b(\w{4})\b/u', $str);

        return view('calculate/text7', ['activeTab' => 'text7', 'str' => $str, 'amountWordsFourLetters' => $amountWordsFourLetters]);
    }
}
