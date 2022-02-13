<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlbumsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('albums', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('group_id');
            $table->unsignedBigInteger('user_id');
            $table->string('name',256)->default('Local');
            $table->boolean('visible')->default(true);
            $table->string('dir',64)->default('local');
            $table->string('location',64)->default('main');
            $table->string('description',512)->default('Empty');
            $table->boolean('public')->default(true);
            $table->boolean('open')->default(true);
            $table->boolean('lock')->default(false);
            $table->string('lock_key',64);
            $table->integer('rate')->default(0);
            $table->boolean('avatar')->default(false);
            $table->string('hash_name', 64);
            $table->string('patch', 256);
            $table->timestamps();
            $table->softDeletes($column = 'deleted_at', $precision = 0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('albums');
    }
}
