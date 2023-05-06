<?php

// Класс Прямоугольник
class Rectangle
{
    // название фигуры
    public readonly string $name; 
 
    // изображение фигуры
    public readonly string $image;
    
    // сторона A
    private float $a;

    function setA(float $a): void
    {
        $this->a = $a > 0 ? $a : throw new Exception("Square: сторона A должа быть больше 0! a: $a");
    }

    function getA(): float
    {
        return $this->a;
    }

    // сторона B
    private float $b;

    function setB(float $b): void
    {
        $this->b = $b > 0 ? $b : throw new Exception("Square: сторона B должа быть больше 0! b: $b");
    }

    function getB(): float
    {
        return $this->b;
    }


    // конструктор
    public function __construct(float $a, float $b)
    {
        $this->name = 'Прямоугольник';
        $this->image = 'rectangle.png';
        $this->setA($a);
        $this->setB($b);
    }
    
    // периметр
    function perimeter(): float
    {
        return $this->a * 4;
    }
    
    // площадь
    function area(): float
    {
        return ($this->a + $this->b) ** 2;
    }

}