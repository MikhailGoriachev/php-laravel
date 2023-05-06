<?php

namespace App\Task01;
spl_autoload_register();

use Models\Task01\Brand;
use PDO;

// Трейт задания 1
trait Task01Trait {

    // объект доступа к базе данных
    private PDO $pdo;

    // конструктор
    public function __construct() {
        
        $db = 'car_rental_goriachev';

        require "../../../db_config.php";

        $this->pdo = new PDO($dsn, $user, $password, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
    }

    // вывод таблицы модели
    public function toTableData(array $data, string $headers): string {
        $rows = array_reduce($data, fn($p, $c) => $p . $c->toTableRow(), '');

        return "
            <table class='table'>
                <thead>
                    $headers   
                </thead>
                
                <tbody>
                    $rows
                </tbody>
            </table>
        ";
    }
}