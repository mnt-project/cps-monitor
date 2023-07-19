<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('group_id');
            $table->boolean('blocked')->default(false);
            $table->boolean('hidden')->default(false);
            $table->boolean('checked')->default(false);
            $table->integer('priority')->default(0);
            $table->integer('views')->default(0);
            $table->integer('rate')->default(0);
            $table->string('titel')->default('empty');
            $table->text('text');
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
        Schema::dropIfExists('blogs');
    }
};
