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
}
