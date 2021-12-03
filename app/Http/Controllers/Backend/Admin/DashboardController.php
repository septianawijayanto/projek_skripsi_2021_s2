<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\Model\Anggota;
use App\Models\Model\Buku;
use App\Models\Model\Level;
use App\Models\Model\Transaksi;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $title = 'Dashboard Admin';


        // $level = Level::get();
        $pinjam = Transaksi::where('status', 'pinjam')->count();
        $selesai = Transaksi::where('status', 'kembali')->count();

        $anggota = Anggota::where('level_id',  1)->count();
        $guru = Anggota::where('level_id', 2)->count();
        $staf = Anggota::where('level_id', 3)->count();
        $buku = Buku::count();
        return view('admin.dashboard.index', compact('title', 'anggota', 'buku', 'pinjam', 'selesai', 'guru'));
    }
}
