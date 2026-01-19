<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailPenjualan extends Model
{

    protected $table = 'detail_penjualan';
    protected $guarded = [];
    public function produk()
    {
        return $this->belongsTo(Product::class, 'id_produk');
    }
}