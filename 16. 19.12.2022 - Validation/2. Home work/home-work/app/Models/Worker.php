<?php

namespace App\Models;

// Работник
class Worker {

    // идентификатор работника
    public int $id;

    // фамилия и инициалы работника
    public string $fullName;

    // название занимаемой должности
    public string $position;

    // пол (true - мужской, false - женский)
    public bool $gender;

    // год поступления на работу
    public int $yearOfEmployment;

    // имя файла с фотографией работника
    public string $image;

    // величина оклада
    public int $salary;


    // конструктор
    public function __construct(int $id = 0, string $fullName = '', string $position = '', bool $gender = true, int $yearOfEmployment = 2022, string $image = '', int $salary = 0) {
        $this->id = $id;
        $this->fullName = $fullName;
        $this->position = $position;
        $this->gender = $gender;
        $this->yearOfEmployment = $yearOfEmployment;
        $this->image = $image;
        $this->salary = $salary;
    }


    // вычисление стажа работника
    public function getExperience(): int {
        return getdate(time())['year'] - $this->yearOfEmployment;
    }

    // десериализация
    public function setDataFromArray(array $data): Worker {
        $this->id = $data['id'] ?? $this->id;
        $this->fullName = $data['fullName'] ?? $this->fullName;
        $this->position = $data['position'] ?? $this->position;
        $this->gender = $data['gender'] ?? $this->gender;
        $this->yearOfEmployment = $data['yearOfEmployment'] ?? $this->yearOfEmployment;
        $this->image = $data['image'] ?? $this->image;
        $this->salary = $data['salary'] ?? $this->salary;

        return $this;
    }
}
