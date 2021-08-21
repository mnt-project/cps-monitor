<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddHiddenToUParametrsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('u_parametrs', function (Blueprint $table) {
            $table->boolean('hidden')->default(false)->after('notifications');
            //
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('u_parametrs', function (Blueprint $table) {
            //
            $table->dropColumn('hidden');
        });
    }
}
