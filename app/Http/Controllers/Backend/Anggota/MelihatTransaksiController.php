<?php

namespace App\Http\Controllers\Backend\Anggota;

use App\Http\Controllers\Controller;
use App\Models\Model\Buku;
use App\Models\Model\Klasifikasi;
use App\Models\Model\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class MelihatTransaksiController extends Controller
{
    public function index(Request $request)
    {
        $title = 'Histori Peminjaman';
        $klasifikasi = Klasifikasi::get();

        return view('anggota.transaksi.peminjaman', compact('title', 'klasifikasi'));
    }
    public function ajax(Request $request)
    {
        $list_transaksi = Transaksi::where('anggota_id', Session::get('id'))->get();
        if ($request->ajax()) {
            return datatables()->of($list_transaksi)->addIndexColumn()
                ->addColumn('status', function ($data) {
                    if ($data->status == 'pinjam') {
                        $badge =   '<span class="label label-primary">' . $data->status . '</span>';
                        return   $badge;
                    } elseif ($data->status == 'kembali') {
                        $badge =   '<span class="label label-success">' . $data->status . '</span>';
                        return   $badge;
                    }
                })
                ->addColumn('nama', function ($data) {
                    return $data->anggota->nama;
                })
                ->addColumn('judul_buku', function ($data) {
                    return $data->buku->judul_buku;
                })
                ->addColumn('tgl_kembali', function ($data) {
                    return date('d F Y, H:i', strtotime($data->tgl_kembali));
                })
                ->addColumn('tgl_pinjam', function ($data) {
                    return date('d F Y, H:i', strtotime($data->tgl_pinjam));
                })
                ->rawColumns(['status', 'nama', 'judul_buku', 'tgl_kembali', 'tgl_pinjam'])
                ->make(true);
        }
    }
    public function tdenda(Request $request)
    {
        $title = 'Histori Denda';
        $list_transaksi = Transaksi::where('status', 'denda')->where('anggota_id', Session::get('id'))->get();
        if ($request->ajax()) {
            return datatables()->of($list_transaksi)->addIndexColumn()
                ->addColumn('status_denda', function ($data) {
                    if ($data->status_denda == 'Belum Lunas') {
                        $badge =   '<span class="label label-danger">' . $data->status_denda . '</span>';
                        return   $badge;
                    } elseif ($data->status_denda == 'Lunas') {
                        $badge =   '<span class="label label-success">' . $data->status_denda . '</span>';
                        return   $badge;
                    }
                })
                ->addColumn('nama', function ($data) {
                    return $data->anggota->nama;
                })
                ->addColumn('judul_buku', function ($data) {
                    return $data->buku->judul_buku;
                })
                ->addColumn('tgl_kembali', function ($data) {
                    return date('d F Y, H:i', strtotime($data->tgl_kembali));
                })
                ->addColumn('tgl_pinjam', function ($data) {
                    return date('d F Y, H:i', strtotime($data->tgl_pinjam));
                })
                ->addColumn('denda', function ($data) {
                    return 'Rp.' . number_format($data->denda, 0);
                })
                ->rawColumns(['denda', 'status_denda', 'nama', 'judul_buku', 'tgl_kembali', 'tgl_pinjam'])
                ->make(true);
        }
        return view('anggota.transaksi.denda', compact('title'));
    }
    public function coba(Request $request)
    {
        // dd($request->all());
        // $post = Transaksi::create([
        //     'kode_transaksi' => $request->kode_transaksi,
        //     'buku_id' => $request->buku,
        //     'anggota_id' => Session::get('id'),
        //     'tgl_pinjam' => $request->tgl_pinjam,
        //     'tgl_kembali' => $request->tgl_kembali,
        //     'status' => 'boking',
        //     'status_denda' => 0,
        //     'denda' => 0,
        // ]);
        $post = Transaksi::create([
            'kode_transaksi' => '$request->kode_transaksi',
            'buku_id' => '$request->buku',
            'anggota_id' => 'Sessio',
            'tgl_pinjam' => '$request->tgl_pinjam',
            'tgl_kembali' => '$request->tgl_kembali',
            'status' => 'boking',
            'status_denda' => 0,
            'denda' => 0,
        ]);
        return response()->json($post);
    }
    public function buku_id($id)
    {
        $buku = Buku::where('klasifikasi_id', $id)->pluck('judul_buku', 'id');
        return response()->json($buku);
    }
}
