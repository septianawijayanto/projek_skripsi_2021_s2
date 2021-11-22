<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\Model\Anggota;
use App\Models\Model\Buku;
use App\Models\Model\Transaksi;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PengembalianController extends Controller
{
    public function index(Request $request)
    {
        $title = 'Transaksi Pengembalian';
        $buku = Buku::get();
        $anggota = Anggota::get();
        return view('admin.pengembalian.index', compact('title', 'anggota', 'buku'));
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
                    }
                })
                ->addColumn('nama', function ($data) {
                    return $data->anggota->nama;
                })
                ->addColumn('judul_buku', function ($data) {
                    return $data->buku->judul_buku;
                })
                ->addColumn('aksi', function ($data) {
                    if ($data->status == 'pinjam') {
                        $button = '<a href="/admin/pengembalian/' . $data->id . '/kembali" type="button" name="kembalikan"  class="kembalikan btn btn-success btn-xs">Kembali</a>';
                        $button .= '&nbsp;';
                        $button .= '<a href="/admin/pengembalian/' . $data->id . '/rusak" type="button" name="kembalikan"  class="kembalikan btn btn-danger btn-xs">Rusak</a>';
                        $button .= '&nbsp;';
                        $button .= '<a href="/admin/pengembalian/' . $data->id . '/hilang" type="button" name="kembalikan"  class="kembalikan btn btn-warning btn-xs">Hilang</a>';

                        return $button;
                    }
                })
                ->addColumn('tgl_kembali', function ($data) {
                    return date('d F Y, H:i', strtotime($data->tgl_kembali));
                })
                ->addColumn('tgl_pinjam', function ($data) {
                    return date('d F Y, H:i', strtotime($data->tgl_pinjam));
                })->addColumn(
                    'denda',
                    function ($data) {

                        $tgl_balek = $data->tgl_kembali;
                        $tgl2 = Carbon::now();
                        if ($data->status == 'kembali') {
                            if ($tgl_balek >= $tgl2) {
                                return '<span class="label label-primary"> <i class="fa fa-check"></span>';
                            } else {
                                return '<span class="label label-danger">' . 'Rp ' . number_format($data->denda, 0) . ' <i class="fa fa-times">' . '</span>';
                            }
                        } else {
                            if ($tgl_balek >= $tgl2) {
                                return '<span class="label label-primary"> <i class="fa fa-check"></span>';
                            } else {
                                $selisih = $tgl2->diffInDays($tgl_balek);
                                return '<span class="label label-danger">' . 'Rp ' . number_format($selisih * 1000, 0) . ' <i class="fa fa-times">' . '</span>';
                            }
                        }
                    }
                )
                ->rawColumns(['status', 'nama', 'judul_buku', 'aksi', 'tgl_kembali', 'tgl_pinjam', 'denda'])
                ->make(true);
        }
    }
    public function kembali($id)
    {
        $post = Transaksi::find($id);

        $tgl_balek = $post->tgl_kembali;
        $tgl2 = Carbon::now();
        $selisih = $tgl2->diffInDays($tgl_balek);

        $idbuku = $post->buku_id;
        $buku = Buku::find($idbuku);
        $saiki = $buku->jumlah;
        $anyar = $saiki + 1;
        $dijilh = $buku->jml_dipinjam;
        $jmlsaiki = $dijilh - 1;
        Buku::where('id', $idbuku)->update([
            'jumlah' => $anyar,
            'jml_dipinjam' => $jmlsaiki,
        ]);
        Transaksi::where('id', $id)->update([
            'status' => 'kembali',
            'denda' => $selisih * 1000,
            'status_denda' => 'denda',
        ]);
        // return view('admin.pengembalian.edit');
        return redirect('admin/pengembalian')->with('sukses', 'Buku Berhasil Dikembalikan');
    }
}
