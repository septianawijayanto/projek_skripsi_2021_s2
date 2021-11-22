<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\Model\Anggota;
use App\Models\Model\Buku;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $title = 'Dashboard Admin';
        $anggota = Anggota::count();
        $buku = Buku::count();
        return view('admin.dashboard.index', compact('title', 'anggota', 'buku'));
    }
}
