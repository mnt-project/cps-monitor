<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            //
            $table->id();
            $table->unsignedBigInteger('user_id')->unique();//Идентификатор пользователя
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('muted')->default(false);
            $table->integer('admin')->default(false);
            $table->integer('sort')->default(false);
            $table->integer('banned')->default(false);
            $table->integer('viewid')->default(false);
            $table->integer('notifications')->default(true);
            $table->integer('language')->default(0);
            $table->integer('hidden')->default(0);
            $table->integer('status')->default(0);
            $table->string('smessage')->default('null');
            $table->integer('reputation')->default(0);
            $table->string('interests', 512)->default('null');
            $table->string('about', 512)->default('null');
            $table->string('notes', 512)->default('null');
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
        Schema::table('settings', function (Blueprint $table) {
            //
        });
    }
}
