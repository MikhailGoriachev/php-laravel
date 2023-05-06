<?php

// Класс Треугольник
class Triangle
{
    // название фигуры
    public readonly string $name;

    // изображение фигуры
    public readonly string $image;

    // стороны
    private array $sides;

    public function getSides(): array
    {
        return [...$this->sides];
    }

    public function setSides(float $a, float $b, float $c): void
    {
        if (self::isTriangle($a, $b, $c)) {
            $this->sides = ['a' => $a, 'b' => $b, 'c' => $c];
            return;
        }

        throw new Exception("Triangle: невалидные значения сторон! a: $a, b: $b, c: $c");
    }

    // сторона A
    public function getA(): float
    {
        return $this->sides['a'];
    }

    // сторона B
    public function getB(): float
    {
        return $this->sides['b'];
    }

    // сторона C
    public function getC(): float
    {
        return $this->sides['c'];
    }

    // конструктор
    public function __construct(float $a, float $b, float $c)
    {
        $this->name = 'Треугольник';
        $this->image = 'triangle.png';
        $this->setSides($a, $b, $c);
    }

    // периметр
    function perimeter(): float
    {
        [$a, $b, $c] = array_values($this->sides);

        return $a + $b + $c;
    }

    // площадь
    function area(): float
    {
        [$a, $b, $c] = array_values($this->sides);

        $p = $this->perimeter() / 2;

        return sqrt($p * ($p - $a) * ($p - $b) * ($p - $c));
    }

    // проверка треугольника
    static function isTriangle(float $a, float $b, float $c): bool
    {
        return $a + $b > $c && $a + $c > $b && $b + $c > $a;
    }
}