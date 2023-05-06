<?php

namespace App\Models;

// простая модель :)
class Person
{
    public string $fullName;
    public int $age;
    public float $salary;

    /**
     * @param string $fileName
     * @param int $age
     * @param float $salary
     */
    public function __construct(string $fullName="", int $age=0, float $salary=0)
    {
        $this->fullName = $fullName;
        $this->age = $age;
        $this->salary = $salary;
    }

    // строковое представление
    public function __toString(): string
    {
        return Utils::mb_sprintf("%s; возраcт, лет: %d; оклад, руб.: %.2f", $this->fullName, $this->age, $this->salary);
    } // __toString

    // представление в виде строки таблицы
    public function toTableRow(): string {
        return Utils::mb_sprintf("| %23s | %12d | %12.2f |", $this->fullName, $this->age, $this->salary);
    }

    // формирование строки в формате CSV
    public function toCsv(): string {
        return "$this->fullName;$this->age;$this->salary";
    } // toCsv

    // парсинг полей из строки а формате CSV
    public function parseCsv($csvRow) {
        $params = array_map('trim', explode(';', $csvRow));
        list($this->fullName, $this->age, $this->salary) = $params;
    } // parseCsv

} // class Person
