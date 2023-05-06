<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

// Класс Цвет
class Color extends Model {
    use HasFactory;

    // отключение автоматической записи в столбцы update_at/create_at
    public $timestamps = false;

    protected $fillable = [
        // название
        'name'
    ];

    // автомобили
    public function cars(): BelongsToMany {
        return $this->belongsToMany(Car::class);
    }
}
