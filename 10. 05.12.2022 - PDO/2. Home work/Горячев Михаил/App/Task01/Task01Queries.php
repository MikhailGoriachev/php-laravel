<?php

namespace App\Task01;

// Запросы
use PDO;

class Task01Queries {

    use Task01Trait;


    // 1. Выбирает информацию об автомобилях, стоимость одного дня проката которых меньше заданной
    public function query01(string|int|null $maxRental = null): array {
        $q = $this->pdo->prepare('call query01_procedure(:max_rental)');
        $q->execute(['max_rental' => $maxRental]);
        return $q->fetchAll(PDO::FETCH_CLASS, 'Models\Task01\Car');
    }


    // 2. Выбирает информацию об автомобилях, страховая стоимость которых находится в заданном диапазоне значений
    public function query02(string|int|null $minInsurancePay = null, string|int|null $maxInsurancePay = null): array {
        $q = $this->pdo->prepare('call query02_procedure(:min_insurance_pay, :max_insurance_pay)');
        $q->execute(['min_insurance_pay' => $minInsurancePay, 'max_insurance_pay' => $maxInsurancePay,]);
        return $q->fetchAll(PDO::FETCH_CLASS, 'Models\Task01\Car');
    }


    // 3. Выбирает информацию о клиентах, серия-номер паспорта которых начинается с заданной параметром цифры.
    // Включает поля Код клиента, Паспорт, Дата начала проката, Количество дней проката, Модель автомобиля
    public function query03(string|null $startPassport = null): array {
        $q = $this->pdo->prepare('call query03_procedure(:start_passport)');
        $q->execute(['start_passport' => $startPassport]);
        return $q->fetchAll(PDO::FETCH_CLASS, 'Models\Task01\Rental');
    }


    // 4. Выбирает информацию о клиентах, бравших автомобиль напрокат в некоторый определенный день.
    public function query04(string|null $date = null): array {
        $q = $this->pdo->prepare('call query04_procedure(:date)');
        $q->execute([':date' => $date]);
        return $q->fetchAll(PDO::FETCH_CLASS, 'Models\Task01\Rental');
    }


    // 5. Выбирает информацию об автомобилях, для которых значение в поле Страховая стоимость автомобиля попадает в
    // некоторый заданный интервал.
    public function query05(string|int|null $minInsurancePay = null, string|int|null $maxInsurancePay = null): array {
        $q = $this->pdo->prepare('call query05_procedure(:min_insurance_pay, :max_insurance_pay)');
        $q->execute(['min_insurance_pay' => $minInsurancePay, 'max_insurance_pay' => $maxInsurancePay,]);
        return $q->fetchAll(PDO::FETCH_CLASS, 'Models\Task01\Car');
    }


    // 6. Вычисляет для каждого автомобиля величину выплачиваемого страхового взноса. Включает поля Госномер автомобиля,
    // Модель автомобиля, Год выпуска автомобиля, Страховая стоимость автомобиля, Страховой взнос.
    // Сортировка по полю Год выпуска автомобиля
    public function query06(): array {
        $q = $this->pdo->query('call query06_procedure()');
        return $q->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function toTableQuery06(array $data): string {
        
        $rows = array_reduce($data, fn($p, $c) => $p . "
            <tr>
                <td>{$c['id']}</td>
                <td>{$c['brand_name']}</td>
                <td>{$c['plate']}</td>
                <td>{$c['year_manufacture']}</td>
                <td>{$c['color_name']}</td>
                <td>{$c['inshurance_pay']}</td>
                <td>{$c['inshurance_pay_value']}</td>
                <td>{$c['rental']}</td>
            </tr>
        ", '');
        
        return "
            <table class='table'>
            <thead> 
                <tr>
                    <th>ID</th>
                    <th>Модель</th>
                    <th>Номер</th>
                    <th>Год выпуска</th>
                    <th>Цвет</th>
                    <th>Страх. стоимость</th>
                    <th>Страх. взнос</th>
                    <th>Аренда</th>
                </tr>
            </thead>
            <tbody>
                $rows
            </tbody>
            </table>
        ";   
    }


    // 7. Выполняет группировку по полю Модель автомобиля. Для каждой модели вычисляет минимальную страховую
    // стоимость автомобиля.
    public function query07(): array {
        $q = $this->pdo->query('call query07_procedure()');
        return $q->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function toTableQuery07(array $data): string {
        $rows = array_reduce($data, fn($p, $c) => $p . "
            <tr>
                <td>{$c['brand_name']}</td>
                <td>{$c['min_insgurance_pay']}</td>
                <td>{$c['avg_insgurance_pay']}</td>
                <td>{$c['max_insgurance_pay']}</td>
                <td>{$c['count']}</td>
            </tr>
        ", '');

        return "
            <table class='table'>
            <thead> 
                <tr>
                    <th>Модель</th>
                    <th>Мин. страх. стоимость</th>
                    <th>Сред. страх. стоимость</th>
                    <th>Макс. страх. стоимость</th>
                    <th>Количество</th>
                </tr>
            </thead>
            <tbody>
                $rows
            </tbody>
            </table>
        ";
    }

    // 8. Добавить запись в таблицу ПРОКАТ
    public function query08(int|string $id_client, int|string $id_car, string $date_start, int $duration): void {
        $q = $this->pdo->prepare('replace into rentals (id_client, id_car, date_start, duration) values (:id_client, :id_car, :date_start, :duration)');
        $q->execute(['id_client' => $id_client, 'id_car' => $id_car, 'date_start' => $date_start, 'duration' => $duration]);
    }

    // 9. Изменить страховую стоимость заданного параметром автомобиля
    public function query09(int|string $id, int|string $id_client, int|string $id_car, string $date_start, int $duration): void {
        $q = $this->pdo->prepare('replace into rentals (id, id_client, id_car, date_start, duration) values (:id, :id_client, :id_car, :date_start, :duration)');
        $q->execute(['id' => $id, 'id_client' => $id_client, 'id_car' => $id_car, 'date_start' => $date_start, 'duration' => $duration]);
    }
}