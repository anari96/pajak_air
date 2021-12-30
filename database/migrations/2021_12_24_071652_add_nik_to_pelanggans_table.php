<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNikToPelanggansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pelanggans', function (Blueprint $table) {
            $table->string('nik')->after('no_telepon')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pelanggans', function (Blueprint $table) {
            $table->dropColumn('nik');
        });
    }
}
