<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

// Класс Тип обуви
class ShoesType extends Model {
    use HasFactory, SoftDeletes;

    protected $fillable = [
        // название
        'name'
    ];


    // обувь
    public function shoes(): BelongsToMany {
        return $this->belongsToMany(Shoes::class);
    }
}
