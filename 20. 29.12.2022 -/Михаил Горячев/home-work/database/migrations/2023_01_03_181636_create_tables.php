<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {

        // жанры
        Schema::create('genres', function (Blueprint $table) {
            $table->id();

            $table->string('name')->unique();

            $table->softDeletes();
            $table->timestamps();
        });

        // страны
        Schema::create('countries', function (Blueprint $table) {
            $table->id();

            $table->string('name')->unique();

            $table->softDeletes();
            $table->timestamps();
        });

        // режиссёры
        Schema::create('producers', function (Blueprint $table) {

            $table->id();

            // фамилия
            $table->string('surname');

            // имя
            $table->string('name');

            // отчество
            $table->string('patronymic')->nullable();

            // фото режиссера
            $table->string('image')->unique();

            // дата рождения
            $table->date('date_of_birth');

            $table->softDeletes();
            $table->timestamps();
        });


        // фильмы
        Schema::create('films', function (Blueprint $table) {

            $table->id();

            // название
            $table->string('name', 170);

            // сведения о режиссере
            $table->unsignedBigInteger('producer_id');

            // дата выхода
            $table->date('release_date');

            // жанр фильма
            $table->unsignedBigInteger('genre_id');

            // бюджет фильма
            $table->integer('budget');

            // картинка – афиша фильма
            $table->string('image')->unique();

            // страна, в которой выпущен фильм
            $table->unsignedBigInteger('country_id');

            $table->foreign('producer_id')->on('producers')->references('id');
            $table->foreign('genre_id')->on('genres')->references('id');
            $table->foreign('country_id')->on('countries')->references('id');

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('films');
        Schema::dropIfExists('genres');
        Schema::dropIfExists('producers');
        Schema::dropIfExists('countries');
    }
};
