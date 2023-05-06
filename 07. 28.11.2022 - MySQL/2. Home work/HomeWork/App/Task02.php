<?php

namespace App;

// Задача 2. Применение PDO. Разработайте базу данных SQLite3. Разработайте код для выполнения запросов с параметрами.
// Параметры запросов вводить из форм
class Task02 {

    // строка подключения
    const CONNECTION_STRING = 'sqlite:../../../app_data/polyclinic.db';

    // база данных
    public \PDO $pdo;


    // конструктор
    public function __construct() { $this->pdo = new \PDO(self::CONNECTION_STRING); }


    // получить данные из таблицы Appointments
    public function getAppointments(): array {
        $q = $this->pdo->prepare('select * from view_appointments');
        $q->execute();
        return $q->fetchAll();
    }

    // вывод данных из таблицы Appointments
    public function toTableAppointments(array $appointments): string {

        $rows = array_reduce($appointments, function ($p, $c) {
            $doctor = $c['doctor_surname'] . ' ' . mb_substr($c['doctor_name'], 0, 1) . '. ' . mb_substr($c['doctor_patronymic'], 0, 1) . '.';
            $patient = $c['patient_surname'] . ' ' . mb_substr($c['patient_name'], 0, 1) . '. ' . mb_substr($c['patient_patronymic'], 0, 1) . '.';

            return $p . "
                <tr>
                    <th>{$c['id']}</th>
                    <td>$doctor</td>
                    <td>$patient</td>
                    <td>{$c['appointment_date']}</td>
                    <td>{$c['percent']}</td>
                    <td>{$c['price']} &#8381;</td>
                    <td class='text-center'>
                        <form class='d-inline' action='../pages/task02/forms/appointmentForm.php' method='post'>
                            <button type='submit' class='btn btn-warning' name='id' value='{$c['id']}' title='Редактировать...'>
                                <i class='bi bi-pencil-fill'></i>
                            </button>                        
                        </form>
                        
                        <form class='d-inline' method='post'>                        
                            <button type='submit' class='btn btn-danger' name='deleteId' value='{$c['id']}' title='Удалить'>
                                <i class='bi bi-trash-fill'></i>
                            </button>                        
                        </form>
                    </td>
                </tr>";
        }, '');

        return <<<EOF
            <table class="table">
                <thead>
                    <th>id</th>
                    <th>Доктор</th>
                    <th>Пациент</th>
                    <th>Дата приёма</th>
                    <th>Процент врачу</th>
                    <th>Стоимость (&#8381;)</th>
                    <th class="text-center">
                        <a class="btn btn-success" href="../pages/task02/forms/appointmentForm.php">
                            <i class="bi bi-plus-lg"></i>Добавить...
                        </a>
                    </th>
                </thead>
                
                <tbody>
                    $rows
                </tbody>
            </table>
        EOF;
    }

    // добавление приёма (берёт данные из POST)
    public function addAppointment(int|string $appointment_date, int|string $id_patient, int|string $id_doctor): void {

        $q = $this->pdo->prepare(
            'insert into appointments (appointment_date, id_patient, id_doctor)
                    values (:appointment_date, :id_patient, :id_doctor)');
        
        $date = (new \DateTime($appointment_date))->format('m-d-Y');
        $q->bindParam(':appointment_date', $date);
        $q->bindParam(':id_patient', $id_patient);
        $q->bindParam(':id_doctor', $id_doctor);
        $q->execute();

        $q->fetch();
    }

    // редактирование приёма (берёт данные из POST)
    public function editAppointment(int|string $id, int|string $appointment_date, int|string $id_patient, int|string $id_doctor): void {
        $q = $this->pdo->prepare(
            'update appointments 
                    set appointment_date = :appointment_date, id_patient = :id_patient, id_doctor = :id_doctor
                    where id = :id');
        

        $date = (new \DateTime($appointment_date))->format('m-d-Y');
        
        $q->bindParam(':id', $id);
        $q->bindParam(':appointment_date', $date);
        $q->bindParam(':id_patient', $id_patient);
        $q->bindParam(':id_doctor', $id_doctor);
        $q->execute();

        $q->fetch();
    }

    // удаление приёма
    public function removeAppointment(int|string $id): void {
        $q = $this->pdo->prepare(
            'delete from appointments
                    where id = :id');

        $q->bindParam(':id', $id);
        $q->execute();

        $q->fetch();
    }

    // получить запись приёма
    public function getAppointment(int|string $id): array {
        $q = $this->pdo->prepare('select * from view_appointments where id = :id');
        $q->bindParam(':id', $id);
        $q->execute();
        return $q->fetch();
    }

    // получить данные из таблицы Doctors
    public function getDoctors(): array {
        $q = $this->pdo->prepare('select * from view_doctors');
        $q->execute();
        return $q->fetchAll();
    }

    // вывод данных из таблицы Doctors
    public function toTableDoctors(array $doctors): string {

        $rows = array_reduce($doctors, fn($p, $c) => $p . "
                <tr>
                    <th>{$c['id']}</th>
                    <td>{$c['doctor_surname']}</td>
                    <td>{$c['doctor_name']}</td>
                    <td>{$c['doctor_patronymic']}</td>
                    <td>{$c['speciality']}</td>
                    <td>{$c['price']}</td>
                    <td>{$c['percent']}</td>
                </tr>",
            '');

        return <<<EOF
            <table class="table">
                <thead>
                    <th>id</th>
                    <th>Фамилия</th>
                    <th>Имя</th>
                    <th>Отчество</th>
                    <th>Специальность</th>
                    <th>Стоимость приёма (&#8381;)</th>
                    <th>Процент врачу</th>
                </thead>
                
                <tbody>
                    $rows
                </tbody>
            </table>
        EOF;

    }

    // получить данные из таблицы Patients
    public function getPatients(): array {
        $q = $this->pdo->prepare('select * from view_patients');
        $q->execute();
        return $q->fetchAll();
    }

    // вывод данных из таблицы Patients
    public function toTablePatients(array $patients): string {

        $rows = array_reduce($patients, fn($p, $c) => $p . "
                <tr>
                    <th>{$c['id']}</th>
                    <td>{$c['patient_surname']}</td>
                    <td>{$c['patient_name']}</td>
                    <td>{$c['patient_patronymic']}</td>
                    <td>{$c['born_date']}</td>
                    <td>{$c['address']}</td>
                    <td>{$c['passport']}</td>
                </tr>",
            '');

        return <<<EOF
            <table class="table">
                <thead>
                    <th>id</th>
                    <th>Фамилия</th>
                    <th>Имя</th>
                    <th>Отчество</th>
                    <th>Дата рождения</th>
                    <th>Адрес проживания</th>
                    <th>Паспорт</th>
                </thead>
                
                <tbody>
                    $rows
                </tbody>
            </table>
        EOF;

    }

    // получить данные из таблицы Persons
    public function getPersons(): array {
        $q = $this->pdo->prepare('select * from persons');
        $q->execute();
        return $q->fetchAll();
    }

    // вывод данных из таблицы Persons
    public function toTablePersons(array $persons): string {

        $rows = array_reduce($persons, fn($p, $a) => $p . "
                <tr>
                    <th>{$a['id']}</th>
                    <td>{$a['surname']}</td>
                    <td>{$a['name']}</td>
                    <td>{$a['patronymic']}</td>
                </tr>",
            '');

        return <<<EOF
            <table class="table">
                <thead>
                    <th>id</th>
                    <th>Фамилия</th>
                    <th>Имя</th>
                    <th>Отчество</th>
                </thead>
                
                <tbody>
                    $rows
                </tbody>
            </table>
        EOF;
    }

    // получить данные из таблицы Specialities
    public function getSpecialities(): array {
        $q = $this->pdo->prepare('select * from specialities');
        $q->execute();
        return $q->fetchAll();
    }

    // вывод данных из таблицы Specialities
    public function toTableSpecialities(array $specialities): string {

        $rows = array_reduce($specialities, fn($p, $c) => $p . "
                <tr>
                    <th>{$c['id']}</th>
                    <td>{$c['speciality']}</td>
                </tr>",
            '');

        return <<<EOF
            <table class="table">
                <thead>
                    <th>id</th>
                    <th>Специальность</th>
                </thead>
                
                <tbody>
                    $rows
                </tbody>
            </table>
        EOF;
    }

    // запрос 1 (Запрос с параметрами)
    // Выбирает информацию о пациентах с фамилиями, начинающимися на заданную последовательность символов
    public function proc01(string $startSurname): array {
        $query = '
            select
                *
            from
                view_patients
            where
                patient_surname like :startSurname
        ';
        $pattern = $startSurname . '%';

        $q = $this->pdo->prepare($query);
        $q->bindParam(':startSurname', $pattern);
        $q->execute();

        return $q->fetchAll();
    }

    // запрос 2 (Запрос с параметрами)
    // Выбирает информацию о врачах, для которых значение в поле Процент отчисления на зарплату, больше заданного
    public function proc02(float $minPercent): array {
        $query = '
            select
                *
            from
                view_doctors
            where
                percent > :minPercent
        ';

        $q = $this->pdo->prepare($query);
        $q->bindParam(':minPercent', $minPercent);
        $q->execute();

        return $q->fetchAll();
    }

    // запрос 3 (Запрос с параметрами)
    // Выбирает информацию о приемах за некоторый период 
    public function proc03(\DateTime $fromDate, \DateTime $toDate): array {
        $query = '
            select
                *
            from
                view_appointments
            where
                appointment_date between :fromDate and :toDate
        ';

        $fromDateFormat = $fromDate->format('m-d-Y');
        $toDateFormat = $toDate->format('m-d-Y');

        $q = $this->pdo->prepare($query);
        $q->bindParam(':fromDate', $fromDateFormat);
        $q->bindParam(':toDate', $toDateFormat);
        $q->execute();

        return $q->fetchAll();
    }

    // запрос 4 (Запрос с параметрами)
    // Выбирает из таблицы информацию о врачах с заданной специальностью
    public function proc04(string $speciality): array {
        $query = '
            select
                *
            from
                view_doctors
            where
                speciality like :speciality
        ';

        $q = $this->pdo->prepare($query);
        $q->bindParam(':speciality', $speciality);
        $q->execute();

        return $q->fetchAll();
    }

    // запрос 5 (Запрос с параметрами)
    // Вычисляет размер заработной платы врача за каждый прием. Включает поля Фамилия врача, Имя врача, Отчество врача,
    // Специальность врача, Стоимость приема, Зарплата. Сортировка по полю Специальность врача
    public function proc05(): array {
        $query = '
            select
		    	doctor_surname
		    	, doctor_name
		    	, doctor_patronymic
		    	, speciality
		    	, price
		    	, [percent]
		    	, (price * ([percent] / 100)) as salary_appointment
		    from
		    	view_appointments
		    order by
		    	speciality;
        ';

        $q = $this->pdo->prepare($query);
        $q->execute();

        return $q->fetchAll();
    }

    // вывод данных из результатов запроса Proc05
    public function toTableProc05(array $results): string {

        $rows = array_reduce($results, function ($p, $c) {
            $doctor = $c['doctor_surname'] . ' ' . mb_substr($c['doctor_name'], 0, 1) . '. ' . mb_substr($c['doctor_patronymic'], 0, 1) . '.';

            return $p . "
                <tr>
                    <td>$doctor</td>
                    <td>{$c['speciality']}</td>
                    <td>{$c['price']}</td>
                    <td>{$c['percent']}</td>
                    <td>{$c['salary_appointment']}</td>
                </tr>";
        }, '');

        return <<<EOF
            <table class="table">
                <thead>
                    <th>Доктор</th>
                    <th>Специальность</th>
                    <th>Цена приёма</th>
                    <th>Процент</th>
                    <th>Зарплата (&#8381;)</th>
                </thead>
                
                <tbody>
                    $rows
                </tbody>
            </table>
        EOF;
    }

    // запрос 6 (Итоговый запрос)
    // Выполняет группировку по полю Дата приема. Для каждой даты вычисляет максимальную стоимость приема
    public function proc06(): array {
        $query = '
            select
		    	view_appointments.appointment_date
		    	, count(*)						as amount
		    	, min(view_appointments.price)	as min_price
		    	, avg(view_appointments.price)	as avg_price
		    	, max(view_appointments.price)	as max_price
		    from
		    	view_appointments
		    group by
		    	view_appointments.appointment_date;
        ';

        $q = $this->pdo->prepare($query);
        $q->execute();

        return $q->fetchAll();
    }

    // вывод данных из результатов запроса Proc06
    public function toTableProc06(array $results): string {

        $rows = array_reduce($results, fn($p, $c) => $p . "
                <tr>
                    <td>{$c['appointment_date']}</td>
                    <td>{$c['amount']}</td>
                    <td>{$c['min_price']}</td>
                    <td>{$c['avg_price']}</td>
                    <td>{$c['max_price']}</td>
                </tr>",
            '');

        return <<<EOF
            <table class="table">
                <thead>
                    <th>Дата</th>
                    <th>Количество</th>
                    <th>Минимальная цена (&#8381;)</th>
                    <th>Средняя цена (&#8381;)</th>
                    <th>Максимальная цена (&#8381;)</th>
                </thead>
                
                <tbody>
                    $rows
                </tbody>
            </table>
        EOF;
    }

    // запрос 7 (Итоговый запрос)
    // Итоговый запрос	Выполняет группировку по полю Специальность. Для каждой специальности вычисляет средний
    // Процент отчисления на зарплату от стоимости приема
    public function proc07(): array {
        $query = '
           select
		    	view_appointments.speciality
		    	, count(*)						    as amount
		    	, min(view_appointments.[percent])	as min_percent
		    	, avg(view_appointments.[percent])	as avg_percent
		    	, max(view_appointments.[percent])	as max_percent
		    from
		    	view_appointments
		    group by
		    	view_appointments.speciality;
        ';

        $q = $this->pdo->prepare($query);
        $q->execute();

        return $q->fetchAll();
    }

    // вывод данных из результатов запроса Proc07
    public function toTableProc07(array $results): string {

        $rows = array_reduce($results, fn($p, $c) => $p . "
                <tr>
                    <td>{$c['speciality']}</td>
                    <td>{$c['amount']}</td>
                    <td>{$c['min_percent']}</td>
                    <td>{$c['avg_percent']}</td>
                    <td>{$c['max_percent']}</td>
                </tr>",
            '');

        return <<<EOF
            <table class="table">
                <thead>
                    <th>Дата</th>
                    <th>Количество</th>
                    <th>Минимальный процент</th>
                    <th>Средний процент</th>
                    <th>Максимальный процент</th>
                </thead>
                
                <tbody>
                    $rows
                </tbody>
            </table>
        EOF;
    }
}