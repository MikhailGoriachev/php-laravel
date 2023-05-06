<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// для "мягкого удаления"
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    // трейт для "мягкого" удаления
    use SoftDeletes;

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

    // вычисляемое поле - total, имя аксессора формируем по соглашению
    // getИмяПоляAttribute
    public function getTotalAttribute() {
        return $this->price * $this->amount;
    } // getTotalAttribute

} // class Product
