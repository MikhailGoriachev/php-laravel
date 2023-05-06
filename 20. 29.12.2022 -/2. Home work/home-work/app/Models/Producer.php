<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

// Класс Режиссёр
class Producer extends Model {
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'surname',
        'name',
        'patronymic',
        'image',
        'date_of_birth',
    ];


    // фильмы
    public function films(): HasMany {
        return $this->hasMany(Film::class);
    }

    // получить количество фильмов
    public function getAmountFilms(): int {
        return $this->films()->count();
    }
}
