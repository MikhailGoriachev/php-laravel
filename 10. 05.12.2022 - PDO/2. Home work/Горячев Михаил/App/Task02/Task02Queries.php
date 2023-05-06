<?php

namespace App\Task02;

// Запросы  
use PDO;

class Task02Queries {

    use Task02Trait;


    // 1. Запрос с параметрами
    // Выбирает информацию об абитуриентах с заданной фамилией, серией/номером паспорта
    public function query01(string $last_name, string $passport): array {
        $q = $this->pdo->prepare('call query01_procedure(:surname, :passport)');
        $q->execute(['surname' => $last_name, 'passport' => $passport]);
        return $q->fetchAll(PDO::FETCH_CLASS, 'Models\Task02\Student');
    }


    // 2. Запрос с параметрами
    // Выбирает информацию об экзаменах, которые были приняты экзаменатором с заданной фамилией
    public function query02(string $last_name): array {
        $q = $this->pdo->prepare('call query02_procedure(:surname)');
        $q->execute(['surname' => $last_name]);
        return $q->fetchAll(PDO::FETCH_CLASS, 'Models\Task02\Exam');
    }


    // 3. Хранимая процедура
    // Выбирает информацию об экзаменах, сданных абитуриентом с заданным номером/серией паспорта
    public function query03(string $passport): array {
        $q = $this->pdo->prepare('call query03_procedure(:passport)');
        $q->execute(['passport' => $passport]);
        return $q->fetchAll(PDO::FETCH_CLASS, 'Models\Task02\Exam');
    }


    // 4. Хранимая процедура
    // Выбирает информацию об абитуриенте с заданным номером/серией паспорта.
    public function query04(string $passport): array {
        $q = $this->pdo->prepare('call query04_procedure(:passport)');
        $q->execute(['passport' => $passport]);
        return $q->fetchAll(PDO::FETCH_CLASS, 'Models\Task02\Student');
    }


    // 5. Хранимая процедура
    // Выбирает информацию обо всех экзаменаторах
    public function query05(): array {
        $q = $this->pdo->prepare('call query05_procedure()');
        $q->execute();
        return $q->fetchAll(PDO::FETCH_CLASS, 'Models\Task02\Examiner');
    }


    // 6. Хранимая процедура
    // Вычисляет для каждого экзамена размер налога (Налог=Размер оплаты*13%) и зарплаты экзаменатора
    // (Зарплата=Размер оплаты - Налог). Сортировка по полю Код экзаменатора
    public function query06(): array {
        $q = $this->pdo->prepare('call query06_procedure()');
        $q->execute();
        return $q->fetchAll(PDO::FETCH_ASSOC);
    }


    public function toTableQuery06(array $data): string {
        $rows = array_reduce($data, function ($p, $c) {

            $examiner = $c['examiner_last_name'] . ' ' . mb_substr($c['examiner_first_name'], 0) . '. ' . mb_substr($c['examiner_patronymic'], 0) . '.';
            $student = $c['student_last_name'] . ' ' . mb_substr($c['student_first_name'], 0) . '. ' . mb_substr($c['student_patronymic'], 0) . '.';

            return $p . "
                <tr>
                    <td>{$c['id']}</td>
                    <td>{$c['academic_subject_name']}</td>
                    <td>$examiner</td>
                    <td>{$c['examiner_exam_fee']}</td>
                    <td>$student</td>
                    <td>{$c['student_address']}</td>
                    <td>{$c['student_passport']}</td>
                    <td>{$c['student_year_of_birth']}</td>
                    <td>{$c['date']}</td>
                    <td>{$c['score']}</td>
                    <td>{$c['tax']}</td>
                    <td>{$c['salary']}</td>
                </tr>
        ";
        }, '');

        return "
            <table class='table'>
            <thead> 
                <tr>
                    <th>ID</th>
                    <th>Предмет</th>
                    <th>Экзаменатор</th>
                    <th>Стоимость</th>
                    <th>Студент</th>
                    <th>Адрес студента</th>
                    <th>Паспорт студента</th>
                    <th>Год рождения</th>
                    <th>Дата экзамена</th>
                    <th>Баллы</th>
                    <th>Налог</th>
                    <th>Зарплата</th>
                </tr>
            </thead>
            <tbody>
                $rows
            </tbody>
            </table>
        ";
    }


    // 7. Хранимая процедура
    // Выполняет группировку по полю Год рождения в таблице АБИТУРИЕНТЫ. Для каждой группы определяет
    // количество абитуриентов (итоги по полю Код абитуриента)
    public function query07(): array {
        $q = $this->pdo->prepare('call query07_procedure()');
        $q->execute();
        return $q->fetchAll(PDO::FETCH_ASSOC);
    }


    public function toTableQuery07(array $data): string {
        $rows = array_reduce($data, fn($p, $c) => $p .
                                                  "
                <tr>
                    <td>{$c['year_of_birth']}</td>
                    <td>{$c['amount']}</td>
                </tr>
        ", '');

        return "
            <table class='table'>
            <thead> 
                <tr>
                    <th>Год рождения</th>
                    <th>Количество студентов</th>
                </tr>
            </thead>
            <tbody>
                $rows
            </tbody>
            </table>
        ";
    }

    // 8. Хранимая процедура
    // Выполняет группировку по полю Дата сдачи экзамена в таблице ЭКЗАМЕНЫ. Для каждой даты определяет
    // среднее значения по полю Оценка
    public function query08(): array {
        $q = $this->pdo->prepare('call query08_procedure()');
        $q->execute();
        return $q->fetchAll(PDO::FETCH_ASSOC);
    }


    public function toTableQuery08(array $data): string {
        $rows = array_reduce($data, fn($p, $c) => $p . "
                <tr>
                    <td>{$c['date']}</td>
                    <td>{$c['min_score']}</td>
                    <td>{$c['avg_score']}</td>
                    <td>{$c['max_score']}</td>
                    <td>{$c['amount']}</td>
                </tr>
        ", '');

        return "
            <table class='table'>
            <thead> 
                <tr>
                    <th>Дата экзамена</th>
                    <th>Мин. балл</th>
                    <th>Сред. балл</th>
                    <th>Макс. балл</th>
                    <th>Количество</th>
                </tr>
            </thead>
            <tbody>
                $rows
            </tbody>
            </table>
        ";
    }


    // 9. Запрос с параметрами
    // Добавить запись о сдаче экзамена абитуриентом
    public function query09(int|string $id_exam_type, int|string $id_examiner, int|string $id_student, string $date, int $score): void {
        $q = $this->pdo->prepare('replace into exams (id_exam_type, id_examiner, id_student, date, score) values (:id_exam_type, :id_examiner, :id_student, :date, :score)');
        $q->execute(['id_exam_type' => $id_exam_type, 'id_examiner' => $id_examiner, 'id_student' => $id_student, 'date' => $date, 'score' => $score]);
    }


    // 10. Запрос с параметрами
    // Удаление записи о сдаче экзамена абитуриентом
    public function query10(int|string $id): void {
        $q = $this->pdo->prepare('delete from exams where id = :id');
        $q->execute(['id' => $id]);
    }
}