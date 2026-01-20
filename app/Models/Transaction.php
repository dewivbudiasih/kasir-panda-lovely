<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $table = 'transactions';

    // PERBAIKAN: Menambahkan kolom pembayaran ke dalam $fillable
    // Tanpa ini, nilai bayar dan kembalian tidak akan tersimpan!
    protected $fillable = [
        'user_id',
        'invoice_code',
        'total_price',
        'bayar',            // <--- WAJIB DITAMBAHKAN
        'kembalian',        // <--- WAJIB DITAMBAHKAN
        'payment_method',   // <--- WAJIB DITAMBAHKAN (Tunai/QRIS)
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function details()
    {
        return $this->hasMany(TransactionDetail::class);
    }
}