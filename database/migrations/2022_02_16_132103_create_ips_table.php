<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ips', function (Blueprint $table) {
            $table->id();
            $table->ipAddress('ip');
            $table->string('name',64)->default('no-name');
            $table->unsignedBigInteger('user_id')->default(0);
            $table->integer('rights')->default(0);
            $table->string('description',256)->default('empty');
            $table->boolean('ban')->default(false);
            $table->timestamp('bandate')->useCurrent();
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
        Schema::dropIfExists('ips');
    }
}
