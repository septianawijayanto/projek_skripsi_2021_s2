<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\Model\Transaksi;
use Illuminate\Http\Request;
use PDF;

class LaporanController extends Controller
{
    public function index()
    {
        $title = 'Laporan';
        return view('admin.laporan.index', compact('title'));
    }
    public function laporan()
    {
        $tgl = date('d F Y');
        $data = Transaksi::all();
        $pdf = PDF::loadview('admin.laporan.pdf', compact('data', 'tgl'))->setPaper('a4', 'Landscape');
        return $pdf->stream();
    }
    public function print(Request $request)
    {
        $tgl = date(' d F Y');
        $query = Transaksi::query();
        if ($request->get('status')) {
            if ($request->get('status') == 'pinjam') {
                $query->where('status', 'pinjam');
            } elseif ($request->get('status') == 'kembali') {
                $query->where('status', 'kembali');
            } elseif ($request->get('status') == 'rusak') {
                $query->where('status', 'rusak');
            } elseif ($request->get('status') == 'hilang') {
                $query->where('status', 'hilang');
            } else {
                $query->where('status', 'tolak');
            }
        }
        $data = $query->get();
        $pdf = PDF::loadview('admin.laporan.pdf', compact('data', 'tgl'))->setPaper('a4', 'Landscape');
        return $pdf->stream();
    }
    public function harian()
    {
        $tgl = date('d F Y');
        $data = Transaksi::where('created_at', today())->get();
        $pdf = PDF::loadview('admin.laporan.harian', compact('data', 'tgl'))->setPaper('a4', 'Landscape');
        return $pdf->stream();
    }
    public function periode(Request $request)
    {
        $tgl = date('d F Y');
        $dari = $request->dari;
        $sampai = $request->sampai;
        // $total = Peminjaman::where('created_at', today())->sum('denda', $denda);

        $data = Transaksi::whereDate('created_at', '>=', $dari)->whereDate('created_at', '<=', $sampai)->orderBy('created_at', 'ASC')->get();
        $pdf = PDF::loadView('admin.laporan.periode', compact('data', 'dari', 'sampai', 'tgl'))->setPaper('a4', 'Landscape');
        //S return $pdf->download('laporan_transaksi_harian' . date('Y-m-d_H-i-s') . '.pdf');
        return $pdf->stream();
    }
}
