<?php

namespace App\Http\Controllers;

use App\Models\Utils;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CalculateController extends Controller {

    // минимальное значение диапазона массива
    const MIN_ARRAY_RANGE = 12;

    // максимальное значение диапазона массива
    const MAX_ARRAY_RANGE = 25;


    // форма для ввода данных выражений
    public function evaluateForm(?float $a = null, ?float $b = null, ?float $m = null, ?float $n = null): View {
        return view('calculate.evaluateForm', ['a' => $a, 'b' => $b, 'm' => $m, 'n' => $n]);
    }

    // выражения
    public function evaluate(Request $request): View {

        $fields = $request->all();

        // выражение 1
        [$a, $b] = [$fields['a'], $fields['b']];

        $temp = 2 * $b - $a;

        [$z1, $z2] = [(sin($a) + cos($temp)) / (cos($a) - sin($temp)), ((1 + sin(2 * $b)) / (cos(2 * $b)))];

        $exp1 = ['a' => $a, 'b' => $b, 'z1' => $z1, 'z2' => $z2];

        // выражение 2
        [$m, $n] = [$fields['m'], $fields['n']];

        [$z1, $z2] = [(($m - 1) * sqrt($m) - ($n - 1) * sqrt($n)) / (sqrt($m ** 3 * $n) + $n * $m + $m ** 2 - $m), (sqrt($m) - sqrt($n)) / $m];

        $exp2 = ['m' => $m, 'n' => $n, 'z1' => $z1, 'z2' => $z2];

        return view('calculate.evaluate', [
            'exp1' => $exp1,
            'exp2' => $exp2
        ]);
    }

    // форма для ввода данных о массиве
    public function arrayForm(?int $min = null, ?int $max = null): View {
        return view('calculate.arrayForm', [
                'n' => random_int(self::MIN_ARRAY_RANGE, self::MAX_ARRAY_RANGE),
                'min' => $min,
                'max' => $max
            ]);
    }

    // массивы
    public function array($n, Request $request): View {

        $zeroCount = random_int(2, 5);

        $fields = $request->all();

        [$min, $max] = [$fields['min'], $fields['max']];

        if ($min > $max)
            return view('shared.error', [
                'message' => "Ошибка диапазона (min: $min; max: $max)",
                'title' => 'Ошибка ввода',
                'activeTab' => 'arrayActive'
            ]);

        if (+$n) {
            $sourceArray = [
                ...array_map(fn() => Utils::random_float($min, $max), array_pad([],
                    ($n ?? random_int(self::MIN_ARRAY_RANGE, self::MAX_ARRAY_RANGE)) - $zeroCount, 0)),
                ...$zeroCount > 0 ? array_fill(0, $zeroCount, 0) : []
            ];
        }

        shuffle($sourceArray);

        // определите количество положительных элементов массива
        $countPositiveItems = array_reduce($sourceArray, fn($p, $c) => $p + ($c > 0 ? 1 : 0), 0);

        // вычислите сумму элементов массива, расположенных после последнего элемента, равного нулю
        $temp = array_reverse($sourceArray);
        $nullLastIndex = array_search(0, $temp);
        $sumItemsAfterLastZeroElem = array_sum(array_slice($temp, 0, $nullLastIndex));

        // преобразуйте массив таким образом, чтобы сначала располагались все элементы,
        // равные нулю, а потом — все остальные
        $sortArray = [...$sourceArray];
        usort($sortArray, fn($a, $b) => ($b === 0) <=> ($a === 0));

        return view('calculate/array', [
            'activeTab' => 'array',
            'sourceArray' => $sourceArray,
            'countPositiveItems' => $countPositiveItems,
            'sumItemsAfterLastZeroElem' => $sumItemsAfterLastZeroElem,
            'sortArray' => $sortArray,
            'min' => $min,
            'max' => $max
        ]);
    }

    // форма для ввода текста и данных
    public function textForm(?string $text = null, ?int $length = null): View {

        $text = $text ?? $str = Utils::getItem([
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

        return view('calculate.textForm', [
            'text' => $text,
            'length' => $length
        ]);
    }

    // текст
    public function text(Request $request): View {

        // поля формы
        $fields = $request->all();

        $str = $fields['text'];

        // /\b(?<let>\w)(?|\w*(\k<let>)\b|\b)/u
        // количество слов начинающихся и заканчивающихся на одну букву регистрозависимо
        $amountWordsStartEndInsensitive = preg_match_all('/\b(?<let>\w)(?|\w*(\k<let>)\b|\b)/ui', $str, $matchStartEndInsensitive);

        // количество слов начинающихся и заканчивающихся на одну букву регистронезависимо
        $amountWordsStartEndSensitive = preg_match_all('/\b(?<let>\w)(?|\w*(\k<let>)\b|\b)/u', $str, $matchStartEndSensitive);

        // количество слов из заданного количества букв
        $amountWordsLenLetters = preg_match_all('/\b(\w{' . $fields['length'] . '})\b/u', $str, $matchLen);

        // функция для получения уникальных значений со счётчиком вхождений
        $toMap = function ($collection) {
            $result = [];
            array_walk($collection, function ($w) use (&$result) {
                $result[$w] = isset($result[$w]) ? $result[$w] + 1 : 1;
            });

            return $result;
        };

        return view('calculate.text', [
            'activeTab' => 'text7',
            'str' => $str,
            'length' => $fields['length'],

            'amountWordsLenLetters' => $amountWordsLenLetters,
            'wordsLenLetters' => $toMap($matchLen[0]),

            'amountWordsStartEndInsensitive' => $amountWordsStartEndInsensitive,
            'wordsStartEndInsensitive' => $toMap($matchStartEndInsensitive[0]),

            'amountWordsStartEndSensitive' => $amountWordsStartEndSensitive,
            'wordsStartEndSensitive' => $toMap($matchStartEndSensitive[0])
        ]);
    }
}
