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
        // производитель
        Schema::create('manufactures', function (Blueprint $t) {
            $t->id();
            $t->string('name')->unique();

            $t->timestamps();
            $t->softDeletes();
        });

        // тип обуви
        Schema::create('shoes_types', function (Blueprint $t) {
            $t->id();
            $t->string('name')->unique();

            $t->timestamps();
            $t->softDeletes();
        });

        // обувь
        Schema::create('shoes', function (Blueprint $t) {
            $t->id();
            $t->string('code')->unique();
            $t->unsignedBigInteger('manufacture_id');
            $t->unsignedBigInteger('shoes_type_id');
            $t->integer('price');

            $t->foreign('manufacture_id')->references('id')->on('manufactures');
            $t->foreign('shoes_type_id')->references('id')->on('shoes_types');

            $t->timestamps();
            $t->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tables');
    }
};
