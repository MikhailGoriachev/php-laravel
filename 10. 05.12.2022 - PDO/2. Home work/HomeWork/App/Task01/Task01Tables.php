<?php

namespace App\Task01;

// Таблицы
use PDO;
use Models\Task01\Brand;
use Models\Task01\Color;
use Models\Task01\Car;
use Models\Task01\Client;
use Models\Task01\Rental;

class Task01Tables {
    
    use Task01Trait;
    
    
    // модели
    public function getBrands(): array {
        return $this->pdo->query('select * from brands order by id')
            ->fetchAll(PDO::FETCH_CLASS, 'Models\Task01\Brand');
    }
    
    
    // цвета
    public function getColors(): array {
        return $this->pdo->query('select * from colors order by id')
            ->fetchAll(PDO::FETCH_CLASS, 'Models\Task01\Color');
    }
    
    
    // клиента
    public function getClients(): array {
        return $this->pdo->query('select * from clients order by id')
            ->fetchAll(PDO::FETCH_CLASS, 'Models\Task01\Client');
    }
    
    
    // автомобили
    public function getCars(): array {
        return $this->pdo->query('select * from cars_view order by id')
            ->fetchAll(PDO::FETCH_CLASS, 'Models\Task01\Car');
    }
    
    
    // аренды
    public function getRentals(): array {
        return $this->pdo->query('select * from rentals_view order by id')
            ->fetchAll(PDO::FETCH_CLASS, 'Models\Task01\Rental');
    }
}