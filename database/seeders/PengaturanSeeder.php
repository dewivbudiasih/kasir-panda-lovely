<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pengaturan;

class PengaturanSeeder extends Seeder
{
    public function run()
    {
        Pengaturan::create([
            'nama_toko' => 'Panda Lovely Store',
            'alamat' => 'Jl.PahlawanNo. 10, Mojokerto',
            'no_hp' => '088230261995',
        ]);
    }
}