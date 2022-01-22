<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\Model\Anggota;
use App\Models\Model\Buku;
use App\Models\Model\Klasifikasi;
use App\Models\Model\Level;
use App\Models\Model\Transaksi;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function index()
    {
        $title = 'Transaksi Peminjaman';

        $getRow = Transaksi::orderBy('id', 'DESC')->get();
        $rowCount = $getRow->count();

        $lastId = $getRow->first();

        $kode = "TR00001";

        if ($rowCount > 0) {
            if ($lastId->id < 9) {
                $kode = "TR0000" . '' . ($lastId->id + 1);
            } else if ($lastId->id < 99) {
                $kode = "TR000" . '' . ($lastId->id + 1);
            } else if ($lastId->id < 999) {
                $kode = "TR00" . '' . ($lastId->id + 1);
            } else if ($lastId->id < 9999) {
                $kode = "TR0" . '' . ($lastId->id + 1);
            } else {
                $kode = "TR" . '' . ($lastId->id + 1);
            }
        }

        $buku = Buku::where('jumlah', '>', 0)->get();
        $klasifikasi = Klasifikasi::get();
        $level = Level::get();
        $anggota = Anggota::get();

        return view('admin.transaksi.index', compact('title', 'buku', 'anggota', 'klasifikasi', 'level', 'kode'));
    }
    public function ajax(Request $request)
    {
        $list_transaksi = Transaksi::all();
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
                ->addColumn('action', function ($data) {

                    // $button = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $data->id . '" data-original-title="Perpanjang" class="btn btn-warning btn-xs perpanjang"> Perpanjang</a>';
                    // $button = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $data->id . '" data-original-title="Edit" class="btn btn-warning btn-xs btn-perpanjang"><i class="lnr lnr-pencil"></i> </a>';
                    if ($data->status == 'pinjam') {
                        $button = '<a href="/admin/transaksi/' . $data->id . '/perpanjang" type="button" name="kembalikan"  class="kembalikan btn btn-warning btn-xs">Perpanjang</a>';
                        return $button;
                    }
                })
                ->addColumn('tgl_kembali', function ($data) {
                    return date('d F Y', strtotime($data->tgl_kembali));
                })
                ->addColumn('tgl_pinjam', function ($data) {
                    return date('d F Y', strtotime($data->tgl_pinjam));
                })
                ->addColumn(
                    'denda',
                    function ($data) {
                        $tgl_balek = $data->tgl_kembali;
                        $tgl2 = today();
                        $selisih = $tgl2->diffInDays($tgl_balek);
                        if ($tgl_balek < $tgl2) {
                            if ($data->status == 'pinjam') {
                                return '<span class="label label-danger">' . 'Rp ' . number_format($selisih * 1000, 0) . ' </span>';
                            } else {
                                return '<span class="label label-danger">' . 'Rp ' . number_format($data->denda, 0) . ' </span>';
                            }
                        } else {
                            return '<span class="label label-danger">' . 'Rp ' . number_format($data->denda, 0) . ' </span>';
                        }
                    }
                )
                ->rawColumns(['status', 'nama', 'judul_buku', 'action', 'tgl_kembali', 'tgl_pinjam', 'denda'])
                ->make(true);
        }
    }

    public function store(Request $request)
    {
        $getRow = Transaksi::orderBy('id', 'DESC')->get();
        $rowCount = $getRow->count();

        $lastId = $getRow->first();

        $kode = "TR00001";

        if ($rowCount > 0) {
            if ($lastId->id < 9) {
                $kode = "TR0000" . '' . ($lastId->id + 1);
            } else if ($lastId->id < 99) {
                $kode = "TR000" . '' . ($lastId->id + 1);
            } else if ($lastId->id < 999) {
                $kode = "TR00" . '' . ($lastId->id + 1);
            } else if ($lastId->id < 9999) {
                $kode = "TR0" . '' . ($lastId->id + 1);
            } else {
                $kode = "TR" . '' . ($lastId->id + 1);
            }
        }

        $anggota = Anggota::where('kode_anggota', $request->kode_anggota)->first();
        if ($anggota == null) {
            return response()->json([
                'error' => true,
                'message' => 'Kode Anggota Tidak Terdaftar',
            ]);
        }
        $cek = Transaksi::whereIn('status', ['pinjam', 'boking'])->where('anggota_id', $anggota->id)->count();
        if ($cek < 2) {
            if (Transaksi::where('anggota_id', $anggota->id)->where('buku_id', $request->get('buku'))->whereIn('status', ['pinjam', 'boking'])->exists()) {
                return response()->json([
                    'error' => true,
                    'message' => 'Buku Sudah Dipinjam',
                ]);
            } else {

                $post = Transaksi::Create(
                    [
                        'kode_transaksi' => $kode,
                        'anggota_id' => $anggota->id,
                        'buku_id' => $request->buku,
                        'tgl_pinjam' => $request->tgl_pinjam,
                        'tgl_kembali' => $request->tgl_kembali,
                        'status' => 'pinjam',
                        'status_denda' => 0,
                        'denda' => 0,
                        'created_at' => Date('Y-m-d', strtotime(Carbon::today()->toDateString()))
                    ]
                );
                $idbuku = $post->buku_id;
                $buku = Buku::find($idbuku);
                $saiki = $buku->jumlah;
                $anyar = $saiki - 1;
                $dijilh = $buku->jml_dipinjam;
                $jmlsaiki = $dijilh + 1;
                Buku::where('id', $idbuku)->update([
                    'jumlah' => $anyar,
                    'jml_dipinjam' => $jmlsaiki,
                ]);
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
    public function nama_buku($id)
    {
        $buku = Buku::where('jumlah', '>', 0)->where('klasifikasi_id', $id)->pluck('judul_buku', 'id');
        return response()->json($buku);
    }
    public function kode_anggota($kode_anggota)
    {
        $anggota = Anggota::where('kode_anggota', $kode_anggota)->pluck('nama', 'kode_anggota');
        return response()->json($anggota);
    }
    public function perpanjang($id)
    {
        $data = Transaksi::find($id);
        Transaksi::where('id', $id)->update(['tgl_kembali' => date('Y-m-d', strtotime(Carbon::today()->addDays(7)->toDateString())),]);
        return redirect()->back()->with('sukses', 'Peminjaman Berhasil Diperpanjang');
    }
    public function get_anggota()
    {
        $kode_anggota = $this->input->post('kode_anggota');
        $data = Anggota::get_data_anggota($kode_anggota);
        echo json_encode($data);
    }
    public function tes($kode_anggota)
    {
        $anggota = Anggota::where('kode_anggota', $kode_anggota)->pluck('nama', 'kode_anggota');
        return response()->json($anggota);
    }
}
