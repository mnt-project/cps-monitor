<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTabsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tabs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');//Идентификатор пользователя
            $table->integer('tabid')->default(0);
            $table->string('titel',32)->default('Empty');
            $table->string('type',64)->default('default.menu');
            $table->integer('value')->default(0);
            $table->string('route',64)->default('default.menu');
            $table->integer('life')->default(1);
            $table->boolean('visible')->default(true);
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
        Schema::dropIfExists('tabs');
    }
}
