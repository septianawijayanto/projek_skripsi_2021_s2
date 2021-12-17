<?php

namespace App\Http\Controllers\Backend\Anggota;

use App\Http\Controllers\Controller;
use App\Models\Model\Buku;
use App\Models\Model\Klasifikasi;
use App\Models\Model\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PeminjamanController extends Controller
{
    public function index()
    {
        $title = 'Histori Transaksi';
        $klasifikasi = Klasifikasi::get();

        return view('anggota.transaksi.index', compact('title', 'klasifikasi'));
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
                    } else {
                        $badge =   '<span class="label label-danger">' . $data->status . '</span>';
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
    public function judulbuku($id)
    {
        $buku = Buku::where('klasifikasi_id', $id)->pluck('judul_buku', 'id');
        return response()->json($buku);
    }
    public function store(Request $request)
    {
        $cek = Transaksi::whereIn('status', ['pinjam', 'boking'])->where('anggota_id', Session::get('id'))->count();
        if ($cek < 2) {
            if (Transaksi::where('anggota_id', Session::get('id'))->where('buku_id', $request->get('buku'))->whereIn('status', ['pinjam', 'boking'])->exists()) {
                return response()->json([
                    'error' => true,
                    'message' => 'Buku Sudah Dipinjam',
                ]);
            } else {
                $post = [
                    'kode_transaksi' => $request->kode_transaksi,
                    'anggota_id' => Session::get('id'),
                    'buku_id' => $request->buku,
                    'tgl_pinjam' => $request->tgl_pinjam,
                    'tgl_kembali' => $request->tgl_kembali,
                    'status' => 'boking',
                    'status_denda' => 0,
                    'denda' => 0,

                ];
                Transaksi::create($post);
                return response()->json([
                    'success' => true,
                    'message' => 'Peminjaman Berhasil ditambah',
                ]);
            }
        } else {
            return response()->json([
                'error' => true,
                'message' => 'Peminjaman Telah Maksimal',
            ]);
        }
    }
}
