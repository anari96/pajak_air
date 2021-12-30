<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;
    
    protected $fillable=['id_pembayaran','tagihan_id','tanggal'];

    protected $dates = ['tanggal','created_at'];

    public function tagihan(){
        return $this->belongsTo(Tagihan::class);
    }
}
