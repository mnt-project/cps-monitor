<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCpsObjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cps_objects', function (Blueprint $table) {
            $table->id();
            $table->integer('region');
            $table->string('address', 64);
            $table->string('street', 64);
            $table->integer('year_start');
            $table->integer('model');
            $table->boolean('status_cps');
            $table->boolean('status_enrg');
            $table->boolean('status_line');
            $table->boolean('status_aarea');
            $table->boolean('status_cath');
            $table->boolean('status_cable');
            $table->integer('indicator_a');
            $table->integer('indicator_b');
            $table->integer('indicator_p');
            $table->integer('indicator_r');
            $table->integer('indicator_c');
            $table->integer('legal_status');
            $table->integer('legal_info');
            $table->integer('physical_status');
            $table->integer('log_id');
            $table->integer('creator_id');
            $table->date('creating_date');
            $table->string('note_text', 256);
            $table->boolean('repair_flag');
            $table->integer('repair_id');
            $table->integer('repair_status');
            $table->integer('repair_founds');
            $table->string('repair_note', 256);
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
        Schema::dropIfExists('cps_objects');
    }
}
