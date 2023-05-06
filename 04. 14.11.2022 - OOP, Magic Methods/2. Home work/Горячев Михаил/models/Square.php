<?php

// Класс Квадрат
class Square
{
    // название фигуры
    public readonly string $name;

    // изображение фигуры
    public readonly string $image;
    
    // сторона
    private float $a;
    
    function setA(float $a): void {
        $this->a = $a > 0 ? $a : throw new Exception("Square: сторона должа быть больше 0! a: $a"); 
    }
    
    function getA(): float {
        return $this->a;
    }
    
    // конструктор
    public function __construct(float $a)
    {
        $this->name = 'Квадрат';
        $this->image = 'square.png';
        $this->setA($a);
    }

    // периметр
    function perimeter(): float
    {
        return $this->a * 4;
    }

    // площадь
    function area(): float
    {
        return $this->a ** 2;
    }
}