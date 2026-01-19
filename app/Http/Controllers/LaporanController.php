<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $tgl_mulai = $request->tgl_mulai;
        $tgl_selesai = $request->tgl_selesai;

        $query = Transaction::query();

        if ($tgl_mulai && $tgl_selesai) {
            $query->whereBetween('created_at', [$tgl_mulai . ' 00:00:00', $tgl_selesai . ' 23:59:59']);
        }

        $queryUntukTotal = clone $query;
        $total_pendapatan = $queryUntukTotal->sum('total_price');

        $laporan = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('admin.laporan.index', [
            'laporan' => $laporan,
            'total_pendapatan' => $total_pendapatan,
            'tanggal_mulai' => $tgl_mulai,
            'tanggal_selesai' => $tgl_selesai
        ]);
    }

    public function cetakPdf(Request $request)
    {
        $tgl_mulai = $request->tgl_mulai;
        $tgl_selesai = $request->tgl_selesai;

        $query = Transaction::query();
        if ($tgl_mulai && $tgl_selesai) {
            $query->whereBetween('created_at', [$tgl_mulai . ' 00:00:00', $tgl_selesai . ' 23:59:59']);
        }

        $laporan = $query->orderBy('created_at', 'asc')->get();
        $total_pendapatan = $laporan->sum('total_price');

        $pdf = Pdf::loadView('admin.laporan.pdf', [
            'laporan' => $laporan,
            'total_pendapatan' => $total_pendapatan,
            'tgl_mulai' => $tgl_mulai,
            'tgl_selesai' => $tgl_selesai
        ]);
        return $pdf->download('laporan-penjualan-' . date('Y-m-d') . '.pdf');
    }
}