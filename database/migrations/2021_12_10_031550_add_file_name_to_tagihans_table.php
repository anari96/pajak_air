<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFileNameToTagihansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tagihans', function (Blueprint $table) {
            $table->text('file_name')->after('jumlah_pembayaran')->nullable();
            $table->text('file_path')->after('file_name')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tagihans', function (Blueprint $table) {
            $table->dropColumn('file_name');
            $table->dropColumn('file_path');
        });
    }
}
