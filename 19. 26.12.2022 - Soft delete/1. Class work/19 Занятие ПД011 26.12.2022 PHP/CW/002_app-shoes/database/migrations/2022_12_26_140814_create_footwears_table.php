<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('footwears', function (Blueprint $table) {
            $table->increments('id');

            // наименование (ботинки, кроссовки и т.д.),
            $table->string('name', 50);

            // уникальный код товара (это не поле первичного ключа id)
            $table->string('code', 12);

            // производитель
            $table->string('manufacturer', 50);

            // цена
            $table->unsignedInteger('price');

            // добавляет солбцы маркеров времени для создания/изменения записи
            $table->timestamps();

            // добавляет солбец deleted_at для "мягкого удаления"
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shoes');
    }
};
