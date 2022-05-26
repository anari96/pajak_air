<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tagihan extends Model
{
    use HasFactory;

    protected $fillable =['id_tagihan','pelanggan_id','tanggal','meter_penggunaan','meter_penggunaan_awal','jumlah_pembayaran','file_name','file_path'];

    protected $dates = ['tanggal'];

    public function pelanggan(){
        return $this->belongsTo(Pelanggan::class);
    }

    public function pembayaran(){
        return $this->hasMany(Pembayaran::class);
    }

    public function getStatusAttribute(){
        $jumlah = $this->pembayaran->count();

        if($jumlah <= 0){
            return "Belum Lunas";
        }else if($jumlah > 0){
            return "Sudah Lunas";
        }else{
            return "Belum Lunas";
        }
    }

    public static function boot() {
        parent::boot();
        self::deleting(function($q) {
             $q->pembayaran()->each(function($q1) {
                $q1->delete();
             });

        });
    }
}