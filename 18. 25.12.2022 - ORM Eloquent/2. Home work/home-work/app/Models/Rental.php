<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

// Класс Прокат
class Rental extends Model {
    use HasFactory;

    // отключение автоматической записи в столбцы update_at/create_at
    public $timestamps = false;

    protected $fillable = [
        // id клиента
        'client_id',

        // id автомобиля
        'car_id',

        // дата проката
        'date_start',

        // длительность
        'duration'
    ];


    // клиент
    public function client(): BelongsTo {
        return $this->belongsTo(Client::class);
    }

    // автомобиль
    public function car(): BelongsTo {
        return $this->belongsTo(Car::class);
    }
}
