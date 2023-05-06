<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

// модель для таблицы footwear
class Footwear extends Model
{
    use HasFactory;

    // трейт для "мягкого" удаления
    use SoftDeletes;

    // поля таблицы для отображения на свойства модели
    protected $fillable = [
        'name',
        'code',
        'manufacturer',
        'price',
    ];

}
