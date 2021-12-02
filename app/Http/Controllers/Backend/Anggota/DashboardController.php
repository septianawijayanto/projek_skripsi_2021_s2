<?php

namespace App\Http\Controllers\Backend\Anggota;

use App\Http\Controllers\Controller;
use App\Models\Model\Buku;
use App\Models\Model\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    public function index()
    {
        $title = 'Dashboard Anggota';
        $pinjam = Transaksi::where('status', 'pinjam')->where('anggota_id', Session::get('id'))->count();
        $selesai = Transaksi::where('status', 'kembali')->where('anggota_id', Session::get('id'))->count();
        $buku = Buku::count();
        return view('anggota.dashboard.index', compact('title','buku','selesai','pinjam'));
    }
}
