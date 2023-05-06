<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // доступные поля таблицы
    protected $fillable = [
        'category',
    ];

    // сторона "один" отношения "1:М" - отношение "имеет"
    public function products() {
        return $this->hasMany(Product::class);
    }
}
