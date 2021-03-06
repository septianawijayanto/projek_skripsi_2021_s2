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
                ->addColumn('aksi', function ($data) {
                    if ($data->status == 'pinjam') {
                        $button = '<a href="/admin/pengembalian/' . $data->id . '/kembali" type="button" name="kembalikan"  class="kembalikan btn btn-success btn-xs">Kembali</a>';
                        $button .= '&nbsp;';
                        $button .= '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $data->id . '" data-original-title="Edit" class="btn btn-danger btn-xs btn-denda">Denda</a>';
                        return $button;
                    }
                })
                ->addColumn('tgl_kembali', function ($data) {
                    return date('d F Y', strtotime($data->tgl_kembali));
                })
                ->addColumn('tgl_pinjam', function ($data) {
                    return date('d F Y', strtotime($data->tgl_pinjam));
                })->addColumn(
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
                ->rawColumns(['status', 'nama', 'judul_buku', 'aksi', 'tgl_kembali', 'tgl_pinjam', 'denda'])
                ->make(true);
        }
    }
    public function kembali($id)
    {
        $dt = Transaksi::find($id);
        $tgl_kembali = $dt->tgl_kembali;
        $tgl2 = today();

        $selisih = $tgl2->diffInDays($tgl_kembali);

        $idbuku = $dt->buku_id;
        $buku = Buku::find($idbuku);
        $saiki = $buku->jumlah;
        $anyar = $saiki + 1;
        $dijilh = $buku->jml_dipinjam;
        $jmlsaiki = $dijilh - 1;
        Buku::where('id', $idbuku)->update([
            'jumlah' => $anyar,
            'jml_dipinjam' => $jmlsaiki,
        ]);

        if ($tgl2 > $tgl_kembali) {
            $denda = 1000 * $selisih;
            Transaksi::where('id', $id)->update([
                'status' => 'kembali',
                'denda' => $denda,
                'status_denda' => 'Belum Lunas',
                'updated_at' => date('Y-m-d', strtotime(Carbon::today()->toDateString())),
            ],);
        } elseif ($tgl2 < $tgl_kembali) {
            $denda = 0;
            Transaksi::where('id', $id)->update([
                'status' => 'kembali',
                'denda' => $denda,
                'status_denda' => 'Bebas Denda',
                'updated_at' => date('Y-m-d', strtotime(Carbon::today()->toDateString())),
            ],);
        }


        return redirect('admin/pengembalian')->with('sukses', 'Buku Berhasil Dikembalikan');
    }
    public function edit($id)
    {
        $post = Transaksi::where('id', $id)->first();
        return response()->json($post);
    }
    public function denda(Request $request)
    {
        $id = $request->id;
        if ($request->status == "rusak") {
            $post = Transaksi::find($id);

            $date = $post->tgl_kembali;
            $datework = Carbon::createFromDate($date);
            $now = Carbon::now();
            $selisih = $datework->diffInDays($now);

            $idbuku = $post->buku_id;
            $buku = Buku::find($idbuku);

            $rusak = $buku->rusak;
            $saiki = $rusak + 1;

            $dijilh = $buku->jml_dipinjam;
            $jmlsaiki = $dijilh - 1;

            Buku::where('id', $idbuku)->update([
                'rusak' => $saiki,
                'jml_dipinjam' => $jmlsaiki,
            ]);
            if ($date < $now) {
                $data = Transaksi::updateOrCreate(
                    ['id' => $id],
                    [
                        'status' => $request->status,
                        'denda' => ($selisih * 1000) + $request->denda,
                        'status_denda' => 'Belum Lunas',
                    ],
                );
                return response()->json($data);
            } else {
                $data = Transaksi::updateOrCreate(
                    ['id' => $id],
                    [
                        'status' => $request->status,
                        'denda' => $request->denda,
                        'status_denda' => 'Belum Lunas',
                    ],
                );
                return response()->json($data);
            }
        } else {
            $post = Transaksi::find($id);

            $date = $post->tgl_kembali;
            $datework = Carbon::createFromDate($date);
            $now = Carbon::now();
            $selisih = $datework->diffInDays($now);

            $idbuku = $post->buku_id;
            $buku = Buku::find($idbuku);

            $hilang = $buku->hilang;
            $saiki = $hilang + 1;

            $dijilh = $buku->jml_dipinjam;
            $jmlsaiki = $dijilh - 1;

            Buku::where('id', $idbuku)->update([
                'hilang' => $saiki,
                'jml_dipinjam' => $jmlsaiki,
            ]);
            if ($date < $now) {
                $data = Transaksi::updateOrCreate(
                    ['id' => $id],
                    [
                        'status' => $request->status,
                        'denda' => ($selisih * 1000) + $request->denda,
                        'status_denda' => 'Belum Lunas',
                    ],
                );
                return response()->json($data);
            } else {
                $data = Transaksi::updateOrCreate(
                    ['id' => $id],
                    [
                        'status' => $request->status,
                        'denda' => $request->denda,
                        'status_denda' => 'Belum Lunas',
                    ],
                );
                return response()->json($data);
            }
        }
    }
    public function rusak(Request $request)
    {
    }
    public function hilang(Request $request)
    {
    }
}
