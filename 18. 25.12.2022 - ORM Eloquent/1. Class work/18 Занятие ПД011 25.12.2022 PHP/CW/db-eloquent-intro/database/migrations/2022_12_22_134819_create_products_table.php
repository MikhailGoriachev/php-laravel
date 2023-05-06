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
            $table->increments('id');  // первичный ключ, можно явно указать имя
            $table->string('name', 46); // ->nullable();
            $table->integer('amount');
            $table->double('price');

            // внешний ключ на categories.id, упс, но это 1:1...
            // $table->unsignedInteger('category_id');
            // $table->foreignId('category_id')->constrained('categories');

            // внешний ключ на categories.id
            $table->unsignedInteger('category_id');
            $table->foreign('category_id')->references('id')->on('categories');

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
