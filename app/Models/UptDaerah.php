<?php

namespace App\Models;

use App\Models\UpdDaerah;
use App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UptDaerah extends Model
{
    use HasFactory;

    protected $fillable = ['nama_daerah'];
}
