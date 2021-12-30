<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    use HasFactory;

    protected $fillable=['name','no_telepon','id_pelanggan','alamat','nik'];

    public function tagihan()
    {
        return $this->hasMany(Tagihan::class);
    }

    public function tagihan_pemasangan()
    {
        return $this->hasMany(TagihanPemasangan::class);
    }

    public static function boot() {
        parent::boot();
        self::deleting(function($q) {
             $q->tagihan()->each(function($q1) {
                $q1->delete();
             });

        });
    }
}