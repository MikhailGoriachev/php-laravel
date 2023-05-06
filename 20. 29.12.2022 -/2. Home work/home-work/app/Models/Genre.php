<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

// Класс Жанр
class Genre extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name'
    ];


    // фильмы
    public function films(): HasMany {
        return $this->hasMany(Film::class);
    }
}
