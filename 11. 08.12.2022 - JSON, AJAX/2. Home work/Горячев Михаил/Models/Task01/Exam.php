<?php

namespace Models\Task01;

use Models\ITable;

// Экзамен
class Exam implements ITable {

    public int $id;

    // учебный предмет
    public string $academic_subject_name;

    // фамилия экзаменатора
    public string $examiner_last_name;

    // имя экзаменатора
    public string $examiner_first_name;

    // отчество экзаменатора
    public string $examiner_patronymic;

    // оплата за экзамен
    public int $examiner_exam_fee;

    // фамилия студента
    public string $student_last_name;

    // имя студента
    public string $student_first_name;

    // отчество студента
    public string $student_patronymic;

    // адрес студента
    public string $student_address;

    // год рождения студента
    public int $student_year_of_birth;

    // паспорт студента
    public string $student_passport;

    // дата
    public string $date;

    // баллы
    public int $score;


    // заголовок таблицы
    static public function headerTable(): string {
        return '
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
                <th class="text-center">
                    <form class="d-inline" action="/src/pages/task01/tables/exams.php" method="post">
                        <button type="submit" class="btn btn-success" name="add" title="Добавить">
                            <i class="bi bi-plus-lg"></i>Добавить...
                        </button>
                    </form>    
                </th>
            </tr>
        ';
    }

    // строка таблицы
    public function toTableRow(): string {
        
        $examiner = $this->examiner_last_name . ' ' . mb_substr($this->examiner_first_name, 0) . '. ' . mb_substr($this->examiner_patronymic, 0) . '.'; 
        $student = $this->student_last_name . ' ' . mb_substr($this->student_first_name, 0) . '. ' . mb_substr($this->student_patronymic, 0) . '.'; 
        
        return "
            <tr>
                <td>$this->id</td>
                <td>$this->academic_subject_name</td>
                <td>$examiner</td>
                <td>$this->examiner_exam_fee</td>
                <td>$student</td>
                <td>$this->student_address</td>
                <td>$this->student_passport</td>
                <td>$this->student_year_of_birth</td>
                <td>$this->date</td>
                <td>$this->score</td>
                <td class='text-center'>
                    <form class='d-inline' action='/src/pages/task01/tables/exams.php' method='post'>
                        <button type='submit' class='btn btn-danger' name='delete' value='$this->id' title='Удалить'>
                            <i class='bi bi-trash-fill'></i>
                        </button>                        
                    </form>    
                </td>
            </tr>
        ";
    }
}