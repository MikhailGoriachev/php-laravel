<?php

namespace Models;

use Exception;

// Класс Планета (Солнечной системы)
class Planet {

    // id
    private int $id;

    public function getId(): int { return $this->id; }

    public function setId($id) { return $this->id = $id; }
    
    
    // название
    private string $name;

    public function getName(): string {
        return $this->name;
    }

    public function setName(string $name): void {
        $this->name = !empty($name) ? $name : throw new Exception("Planet: поле Name не может быть пустым!");
    }


    // радиус
    private float $radius;

    public function getRadius(): float {
        return $this->radius;
    }

    public function setRadius(float $radius): void {
        $this->radius = $radius > 0 ? $radius : throw new Exception("Planet: значения поля Radius должно быть больше 0!");
    }


    // масса
    private float $mass;

    public function getMass(): float {
        return $this->mass;
    }

    public function setMass(float $mass): void {
        $this->mass = $mass > 0 ? $mass : throw new Exception("Planet: значения поля Mass должно быть больше 0!");
    }


    // количество спутников
    private int $amountSatellites;

    public function getAmountSatellites(): int {
        return $this->amountSatellites;
    }

    public function setAmountSatellites(int $amountSatellites): void {
        $this->amountSatellites = $amountSatellites >= 0 ? $amountSatellites : throw new Exception("Planet: значения AmountSatellites не может быть отрицательным!");
    }


    // расстояние до слонца в а.е.
    private float $distance;

    public function getDistance(): float {
        return $this->distance;
    }

    public function setDistance(float $distance): void {
        $this->distance = $distance > 0 ? $distance : throw new Exception("Planet: значения поля Distance должно быть больше 0!");
    }


    // изображение
    private string $image;

    public function getImage(): string {
        return $this->image;
    }

    public function setImage(string $image): void {
        $this->image = $image;
    }


    // конструктор
    public function __construct(int $id, string $name, float $radius, float $mass, int $amountSatellites, float $distance, string $image) {
        $this->setId($id);
        $this->setName($name);
        $this->setRadius($radius);
        $this->setMass($mass);
        $this->setAmountSatellites($amountSatellites);
        $this->setDistance($distance);
        $this->setImage($image);
    }


    // получить массив значений
    public function getArrayValues(): array {
        return [
            $this->id,
            $this->name,
            $this->radius,
            $this->mass,
            $this->amountSatellites,
            $this->distance,
            $this->image
        ];
    }
}