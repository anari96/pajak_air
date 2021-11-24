<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tagihan extends Model
{
    use HasFactory;

    protected $fillable =['id_tagihan','pelanggan_id','tanggal','meter_penggunaan','jumlah_pembayaran'];

    protected $dates = ['tanggal'];

    public function pelanggan(){
        return $this->belongsTo(Pelanggan::class);
    }
}