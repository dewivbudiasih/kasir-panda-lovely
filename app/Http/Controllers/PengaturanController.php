<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengaturan;

class PengaturanController extends Controller
{
    public function index()
    {
    
        $setting = Pengaturan::first() ?? new Pengaturan();
        return view('admin.pengaturan.index', compact('setting'));
    }

    public function update(Request $request)
    {
 
        $request->validate([
            'nama_toko' => 'required|string|max:255',
            'no_hp'     => 'nullable|string',
            'alamat'    => 'nullable|string',
        ]);

        Pengaturan::updateOrCreate(
            ['id' => 1], 
            [
                'nama_toko' => $request->nama_toko,
                'no_hp'     => $request->no_hp,
                'alamat'    => $request->alamat,
            ]
        );

        return redirect()->back()->with('success', 'Pengaturan berhasil disimpan!');
    }
}