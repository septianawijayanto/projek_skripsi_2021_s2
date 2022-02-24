<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\Model\Anggota;
use App\Models\Model\Buku;
use App\Models\Model\Level;
use App\Models\Model\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    public function index()
    {
        if (Session::get('level') == 'Admin') {
            $title = 'Dashboard Admin';
        } else {
            $title = 'Dashboard Kepala Sekolah';
        }



        // $level = Level::get();
        $pinjam = Transaksi::where('status', 'pinjam')->count();
        $selesai = Transaksi::where('status', 'kembali')->count();

        $anggota = Anggota::where('level_id',  1)->count();
        $guru = Anggota::where('level_id', 2)->count();
        $staf = Anggota::where('level_id', 3)->count();
        $buku = Buku::count();
        return view('admin.dashboard.index', compact('title', 'staf', 'anggota', 'buku', 'pinjam', 'selesai', 'guru'));
    }
}
