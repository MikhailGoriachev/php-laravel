<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // жадная загрузка по умолчанию
    protected $with = ['article'];

    // доступные поля таблицы
    protected $fillable = [
        'category',
        'article_id'
    ];

    // Все связи в Laravel работают через соглашение: имена таблиц всегда
    // даются во множественном числе, а поля связи - в единственном.

    // сторона "один" отношения "1:М" - отношение "имеет"
    public function product() {
        return $this->hasMany(Product::class);
    } // product

    // сторона "один" отношения 1:1 с таблицей articles "принадлежит"
    public function article() {
        return $this->belongsTo(Article::class);
    } // article
}
