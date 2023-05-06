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
        Schema::create('products', function (Blueprint $table) {
            // $table->id();                  // первичный ключ, id
            $table->increments('id');  // первичный ключ, моджно явно указать имя
            $table->string('name', 46); // ->nullable();
            $table->integer('amount');
            $table->double('price');

            // внешний ключ на categories.id, упс, но это 1:1...
            $table->foreignId('id_category')->constrained('categories');

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
        Schema::dropIfExists('products');
    }
};
