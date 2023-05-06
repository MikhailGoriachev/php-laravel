<?php

use App\Task01\Task01Queries;

spl_autoload_register(fn($className) => require $fileName = '..\\..\\' . $className . '.php');

// название запроса
$queryName = $_POST['queryName'] ?? 'query01';

if (empty($queryName))
    die();

$queries = new Task01Queries();

echo json_encode(match ($queryName) {
    'query01' => $queries->query01($_POST['last_name'] ?? '', $_POST['passport'] ?? ''),
    'query02' => $queries->query02($_POST['last_name'] ?? ''),
    'query03' => $queries->query03($_POST['passport'] ?? ''),
    'query04' => $queries->query04($_POST['passport'] ?? ''),
    'query05' => $queries->query05(),
    'query06' => $queries->query06(),
    'query07' => $queries->query07(),
    'query08' => $queries->query08(),
});