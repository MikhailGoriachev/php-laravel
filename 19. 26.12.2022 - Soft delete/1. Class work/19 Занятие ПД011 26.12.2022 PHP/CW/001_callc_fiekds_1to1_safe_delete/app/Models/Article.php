<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// артикул - для демолнстрации связи 1:1 с таблицей categories
class Article extends Model
{
    use HasFactory;

    // доступные поля таблицы
    protected $fillable = [
        'name',
    ];

    // Все связи в Laravel работают через соглашение: имена таблиц всегда
    // даются во множественном числе, а поля связи - в единственном.

    // вторая сторона отношения 1:1 "имеет"
    public function category() {
        return $this->hasOne(Category::class);
    } // category

}
