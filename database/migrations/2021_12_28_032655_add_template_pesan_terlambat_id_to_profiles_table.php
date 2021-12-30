<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTemplatePesanTerlambatIdToProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('profiles', function (Blueprint $table) {
            $table->foreignId('template_pesan_id')->after('harga_pemasangan_dp')->nullable();
            $table->foreignId('template_pesan_terlambat_id')->after('template_pesan_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('profiles', function (Blueprint $table) {
            $table->dropColumn('template_pesan_id');
            $table->dropColumn('template_pesan_terlambat_id');
        });
    }
}
