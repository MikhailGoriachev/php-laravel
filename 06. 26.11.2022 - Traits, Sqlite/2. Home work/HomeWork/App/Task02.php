<?php

namespace App;

// Задача 2. Применение PDO. Разработайте базу данных SQLite3. Разработайте код для выполнения запросов с параметрами.
// Параметры запросов вводить из форм
class Task02 {

    // строка подключения
    const CONNECTION_STRING = 'sqlite:../../../App_Data/Polyclinic.db';

    // база данных
    public \PDO $pdo;


    // конструктор
    public function __construct() { $this->pdo = new \PDO(self::CONNECTION_STRING); }


    // получить данные из таблицы Appointments
    public function getAppointments(): array {
        $q = $this->pdo->prepare('select * from ViewAppointments');
        $q->execute();
        return $q->fetchAll();
    }

    // вывод данных из таблицы Appointments
    public function toTableAppointments(array $appointments): string {

        $rows = array_reduce($appointments, function ($p, $c) {
            $doctor = $c['DoctorSurname'] . ' ' . mb_substr($c['DoctorName'], 0, 1) . '. ' . mb_substr($c['DoctorPatronymic'], 0, 1) . '.';
            $patient = $c['PatientSurname'] . ' ' . mb_substr($c['PatientName'], 0, 1) . '. ' . mb_substr($c['PatientPatronymic'], 0, 1) . '.';

            return $p . "
                <tr>
                    <th>{$c['Id']}</th>
                    <td>$doctor</td>
                    <td>$patient</td>
                    <td>{$c['AppointmentDate']}</td>
                    <td>{$c['Percent']}</td>
                    <td>{$c['Price']} &#8381;</td>
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
                </thead>
                
                <tbody>
                    $rows
                </tbody>
            </table>
        EOF;
    }

    // получить данные из таблицы Doctors
    public function getDoctors(): array {
        $q = $this->pdo->prepare('select * from ViewDoctors');
        $q->execute();
        return $q->fetchAll();
    }

    // вывод данных из таблицы Doctors
    public function toTableDoctors(array $doctors): string {

        $rows = array_reduce($doctors, fn($p, $c) => $p . "
                <tr>
                    <th>{$c['Id']}</th>
                    <td>{$c['DoctorSurname']}</td>
                    <td>{$c['DoctorName']}</td>
                    <td>{$c['DoctorPatronymic']}</td>
                    <td>{$c['Speciality']}</td>
                    <td>{$c['Price']}</td>
                    <td>{$c['Percent']}</td>
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
        $q = $this->pdo->prepare('select * from VIewPatients');
        $q->execute();
        return $q->fetchAll();
    }

    // вывод данных из таблицы Patients
    public function toTablePatients(array $patients): string {

        $rows = array_reduce($patients, fn($p, $c) => $p . "
                <tr>
                    <th>{$c['Id']}</th>
                    <td>{$c['PatientSurname']}</td>
                    <td>{$c['PatientName']}</td>
                    <td>{$c['PatientPatronymic']}</td>
                    <td>{$c['BornDate']}</td>
                    <td>{$c['Address']}</td>
                    <td>{$c['Passport']}</td>
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
        $q = $this->pdo->prepare('select * from Persons');
        $q->execute();
        return $q->fetchAll();
    }

    // вывод данных из таблицы Persons
    public function toTablePersons(array $persons): string {

        $rows = array_reduce($persons, fn($p, $a) => $p . "
                <tr>
                    <th>{$a['Id']}</th>
                    <td>{$a['Surname']}</td>
                    <td>{$a['Name']}</td>
                    <td>{$a['Patronymic']}</td>
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
        $q = $this->pdo->prepare('select * from Specialities');
        $q->execute();
        return $q->fetchAll();
    }

    // вывод данных из таблицы Specialities
    public function toTableSpecialities(array $specialities): string {

        $rows = array_reduce($specialities, fn($p, $c) => $p . "
                <tr>
                    <th>{$c['Id']}</th>
                    <td>{$c['Speciality']}</td>
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
                ViewPatients
            where
                PatientSurname like :startSurname
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
                ViewDoctors
            where
                Percent > :minPercent
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
                ViewAppointments
            where
                AppointmentDate between :fromDate and :toDate
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
                ViewDoctors
            where
                Speciality like :speciality
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
		    	DoctorSurname
		    	, DoctorName
		    	, DoctorPatronymic
		    	, Speciality
		    	, Price
		    	, [Percent]
		    	, (Price * ([Percent] / 100)) as SalaryAppointment
		    from
		    	ViewAppointments
		    order by
		    	Speciality;
        ';

        $q = $this->pdo->prepare($query);
        $q->execute();

        return $q->fetchAll();
    }

    // вывод данных из результатов запроса Proc05
    public function toTableProc05(array $results): string {

        $rows = array_reduce($results, function ($p, $c) {
            $doctor = $c['DoctorSurname'] . ' ' . mb_substr($c['DoctorName'], 0, 1) . '. ' . mb_substr($c['DoctorPatronymic'], 0, 1) . '.';

            return $p . "
                <tr>
                    <td>$doctor</td>
                    <td>{$c['Speciality']}</td>
                    <td>{$c['Price']}</td>
                    <td>{$c['Percent']}</td>
                    <td>{$c['SalaryAppointment']}</td>
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
		    	ViewAppointments.AppointmentDate
		    	, Count(*)						as Amount
		    	, Min(ViewAppointments.Price)	as MinPrice
		    	, Avg(ViewAppointments.Price)	as AvgPrice
		    	, Max(ViewAppointments.Price)	as MaxPrice
		    from
		    	ViewAppointments
		    group by
		    	ViewAppointments.AppointmentDate;
        ';

        $q = $this->pdo->prepare($query);
        $q->execute();

        return $q->fetchAll();
    }

    // вывод данных из результатов запроса Proc06
    public function toTableProc06(array $results): string {

        $rows = array_reduce($results, fn($p, $c) => $p . "
                <tr>
                    <td>{$c['AppointmentDate']}</td>
                    <td>{$c['Amount']}</td>
                    <td>{$c['MinPrice']}</td>
                    <td>{$c['AvgPrice']}</td>
                    <td>{$c['MaxPrice']}</td>
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
		    	ViewAppointments.Speciality
		    	, Count(*)						as Amount
		    	, Min(ViewAppointments.[Percent])	as MinPercent
		    	, Avg(ViewAppointments.[Percent])	as AvgPercent
		    	, Max(ViewAppointments.[Percent])	as MaxPercent
		    from
		    	ViewAppointments
		    group by
		    	ViewAppointments.Speciality;
        ';

        $q = $this->pdo->prepare($query);
        $q->execute();

        return $q->fetchAll();
    }

    // вывод данных из результатов запроса Proc07
    public function toTableProc07(array $results): string {

        $rows = array_reduce($results, fn($p, $c) => $p . "
                <tr>
                    <td>{$c['Speciality']}</td>
                    <td>{$c['Amount']}</td>
                    <td>{$c['MinPercent']}</td>
                    <td>{$c['AvgPercent']}</td>
                    <td>{$c['MaxPercent']}</td>
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