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
        // создание таблицы categories
        Schema::create('categories', function (Blueprint $table) {
            $table->id();  // первичный ключ
            $table->string('category', 45);  // varchar(45)

            // моменты времени создания и последнего доступа
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
};
