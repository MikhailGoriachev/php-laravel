<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

// Класс Фильм
class Film extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        // название
        'name',
        // сведения о режиссере
        'producer_id',
        // дата выхода
        'release_date',
        // жанр фильма
        'genre_id',
        // бюджет фильма
        'budget',
        // картинка – афиша фильма
        'image',
        // страна, в которой выпущен фильм
        'country_id'
    ];


    // сведения о режиссере
    public function producer() : BelongsTo {
        return $this->belongsTo(Producer::class);
    }

    // жанр фильма
    public function genre() : BelongsTo {
        return $this->belongsTo(Genre::class);
    }

    // страна
    public function country() : BelongsTo {
        return $this->belongsTo(Country::class);
    }
}
