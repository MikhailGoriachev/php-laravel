<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // поля таблицы для отображения на свойства модели
    protected $fillable = [
        'name',
        'amount',
        'price',
        'category_id'
    ];

    // сторона "много" отношение "1:М", отношение "принадлежит"
    // !!! такие связи могут быть с нексолькими таблицами !!!
    public function category() {
        return $this->belongsTo(Category::class);
    }

}
