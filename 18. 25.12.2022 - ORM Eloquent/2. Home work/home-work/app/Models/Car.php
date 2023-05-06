<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

// Класс Автомобиль
class Car extends Model {
    use HasFactory;

    // отключение автоматической записи в столбцы update_at/create_at
    public $timestamps = false;

    protected $fillable = [
        // id модели
        'brand_id',

        // id цвета
        'color_id',

        // госномер
        'plate',

        // год выпуска
        'year_manufacture',

        // страховая стоимость
        'inshurance_pay',

        // стоимость одного дня проката
        'rental'
    ];


    // модель
    public function brand(): BelongsTo {
        return $this->belongsTo(Brand::class, );
    }

    // цвет
    public function color(): BelongsTo {
        return $this->belongsTo(Color::class);
    }
}
