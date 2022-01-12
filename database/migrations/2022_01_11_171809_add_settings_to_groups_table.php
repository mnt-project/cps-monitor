<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSettingsToGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('groups', function (Blueprint $table) {
            //
            $table->integer('rate')->default(0)->after('invite');
            $table->integer('visits')->default(0)->after('rate');
            $table->integer('online')->default(0)->after('visits');
            $table->integer('balance')->default(0)->after('online');
            $table->integer('albumid')->default(0)->after('balance');
            $table->integer('galleryid')->default(0)->after('albumid');
            $table->boolean('visibility')->default(true)->after('galleryid');
            $table->integer('position')->default(0)->after('visibility');
            $table->integer('state')->default(0)->after('position');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('groups', function (Blueprint $table) {
            //
            $table->dropColumn('rate');
            $table->dropColumn('visits');
            $table->dropColumn('online');
            $table->dropColumn('balance');
            $table->dropColumn('albumid');
            $table->dropColumn('galleryid');
            $table->dropColumn('visibility');
            $table->dropColumn('position');
            $table->dropColumn('state');
        });
    }
}
