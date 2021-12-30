<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTagihanPemasangansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tagihan_pemasangans', function (Blueprint $table) {
            $table->id();
            $table->string('id_tagihan_pemasangan');
            $table->unsignedBigInteger('pelanggan_id');
            $table->integer('tipe_pembayaran');
            $table->integer('jumlah_pembayaran');
            $table->date('tanggal');
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
        Schema::dropIfExists('tagihan_pemasangans');
    }
}
