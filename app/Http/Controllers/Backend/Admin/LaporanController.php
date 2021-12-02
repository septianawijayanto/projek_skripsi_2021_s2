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
}
