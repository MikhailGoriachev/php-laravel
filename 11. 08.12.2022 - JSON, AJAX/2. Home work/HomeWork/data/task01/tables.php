<?php

use App\Task01\Task01Tables;
spl_autoload_register(fn($className) => require $fileName = '..\\..\\' . $className . '.php');

// название таблицы
$tableName = $_POST['tableName'] ?? '';

if (empty($tableName))
    die();

$tables = new Task01Tables();

echo json_encode(match ($tableName) {
    'academic_subjects' => $tables->getAcademicSubject(),
    'examiners' => $tables->getExaminers(),
    'exams' => $tables->getExams(),
    'examTypes' => $tables->getExamTypes(),
    'people' => $tables->getPeople(),
    'students' => $tables->getStudents(),
});