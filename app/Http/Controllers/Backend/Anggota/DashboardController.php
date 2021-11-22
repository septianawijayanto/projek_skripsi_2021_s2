<?php

namespace App\Http\Controllers\Backend\Anggota;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $title = 'Dashboard Anggota';
        return view('anggota.dashboard.index', compact('title'));
    }
}
