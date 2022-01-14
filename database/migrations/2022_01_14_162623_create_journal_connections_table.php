<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJournalConnectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('journal_connections', function (Blueprint $table) {
            $table->id();
            $table->ipAddress('visitor');
            $table->integer('status')->default(0);
            $table->string('dirname', 32)->default('local');
            $table->string('basename', 32)->default('default');
            $table->string('filename', 32)->default('default');
            $table->string('agent', 512)->default('default');
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
        Schema::dropIfExists('journal_connections');
    }
}
