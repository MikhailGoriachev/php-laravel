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
        // создание таблицы articles
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id');

            // значение артикула
            $table->string('name', 20);

            $table->timestamps();
        });

        // создание таблицы categories
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');  // первичный ключ
            $table->string('name', 45);  // varchar(45)

            // внешний ключ на articles.id
            $table->unsignedInteger('article_id');
            $table->foreign('article_id')->references('id')->on('articles');

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
        Schema::dropIfExists('articles');
    }
};
