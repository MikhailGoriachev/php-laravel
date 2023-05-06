<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

// Класс Обувь
class Shoes extends Model {
    use HasFactory, SoftDeletes, HasFactory;

    protected $fillable = [
        'manufacture_id',
        'shoes_type_id',
        'code',
        'name',
        'price'
    ];


    // изготовитель
    public function manufacture(): BelongsTo {
        return $this->belongsTo(Manufacture::class);
    }

    // тип обуви
    public function shoes_type(): BelongsTo {
        return $this->belongsTo(ShoesType::class);
    }
}
