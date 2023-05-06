<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Класс Клиент
class Client extends Model {
    use HasFactory;

    // отключение автоматической записи в столбцы update_at/create_at
    public $timestamps = false;

    protected $fillable = [
        // имя
        'first_name',

        // фамилия
        'last_name',

        // отчество
        'patronymic',

        // паспорт
        'passport',
    ];
}
