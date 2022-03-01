<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('group_posts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('post_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('group_id');
            $table->boolean('resource')->default(false);
            $table->unsignedBigInteger('recource_id')->nullable();
            $table->boolean('checked')->default(false);
            $table->boolean('public')->default(true);
            $table->boolean('blocked')->default(false);
            $table->string('path')->default('/');
            $table->string('style')->nullable();
            $table->string('titel')->default('empty');
            $table->longText('text')->nullable();
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
        Schema::dropIfExists('group_posts');
    }
}
