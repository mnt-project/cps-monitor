<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUParametrsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('u_parametrs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->unique();//Идентификатор пользователя
            $table->foreign('user_id')->references('id')->on('users');
            $table->boolean('muted')->default(false);//Флаг мута
            $table->boolean('admin')->default(false);//Флаг удаления
            $table->integer('sort')->default(0);//Флаг админа
            $table->boolean('banned')->default(false);
            $table->integer('viewid')->default(0);
            $table->boolean('notifications')->default(true);
            $table->integer('language')->default(0);
            $table->boolean('private_profile')->default(false);
            $table->integer('status')->default(0);
            $table->string('smessage')->default('null');
            $table->integer('reputation')->default(0);
            $table->string('interests', 512)->default('null');
            $table->string('about', 512)->default('null');
            $table->string('notes', 512)->default('null');//Заметка о пользователе
            $table->timestamp('connected_at')->nullable();

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
        Schema::dropIfExists('u_parametrs');
    }
}
