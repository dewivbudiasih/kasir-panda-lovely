<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    protected $table = 'penjualan';
    protected $guarded = [];
    public function detail()
    {
        return $this->hasMany(DetailPenjualan::class, 'id_penjualan');
    }

    public function kasir()
    {
        return $this->belongsTo(User::class, 'id_kasir');
    }
}