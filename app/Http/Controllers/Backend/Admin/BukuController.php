<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\Model\Buku;
use App\Models\Model\Klasifikasi;
use App\Models\Model\Penerbit;
use Illuminate\Http\Request;
use File;
use PDF;

class BukuController extends Controller
{
    public function index(Request $request)
    {
        $title = 'Data Buku';
        $klasifikasi = Klasifikasi::get();
        $penerbit = Penerbit::get();
        $kelas = ['Umum', 'VII', 'VIII', 'IX'];
        $list_buku = Buku::all();
        if ($request->ajax()) {
            return datatables()->of($list_buku)->addIndexColumn()
                ->addColumn('penerbit', function ($data) {
                    return $data->penerbit->nama_penerbit;
                })
                ->addColumn('klasifikasi', function ($data) {
                    return $data->klasifikasi->nama_klasifikasi;
                })
                ->addColumn('action', function ($data) {
                    $button = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $data->id . '" data-original-title="Edit" class="btn btn-warning btn-xs edit-post"><i class="lnr lnr-pencil"></i> </a>';
                    $button .= '&nbsp;&nbsp;';
                    $button .= '<button type="button" name="delete" id="' . $data->id . '"  class="delete btn btn-danger btn-xs"><i class="lnr lnr-trash"></i></button>';
                    $button .= '&nbsp;&nbsp;';
                    $button .= '<a href="/admin/buku/' . $data->id . '/show"  class="btn btn-success btn-xs"><i class="fa fa-search"></I></a>';
                    return $button;
                })
                ->addColumn('gambar', function ($data) {
                    $gambar = '<img src="' . $data->getGambar() . '"" width="100" height="100"
                                            class="rounded-circle">';
                    return  $gambar;
                })
                ->rawColumns(['penerbit', 'klasifikasi', 'action', 'gambar'])
                ->make(true);
        }
        return view('admin.buku.index', compact('title', 'klasifikasi', 'penerbit', 'kelas'));
    }
    public function store(Request $request)
    {

        $id = $request->id;
        $post =
            [
                'kode' => $request->kode,
                'judul_buku' => $request->judul_buku,
                'penerbit_id' => $request->penerbit_id,
                'klasifikasi_id' => $request->klasifikasi_id,
                'penulis' => $request->penulis,
                'kelas' => $request->kelas,
                'tahun_terbit' => $request->tahun_terbit,
                'tahun_pengadaan' => $request->tahun_pengadaan,
                'jumlah' => $request->jumlah,
                'sumber_dana' => $request->sumber_dana,
            ];
        if ($id != null) {
            if ($gambars = $request->file('gambar')) {
                $gambar = Buku::where('id', $request->id)->first();
                File::delete('gambar/buku/' . $gambar->gambar);
                $tujuan = 'gambar/buku/';
                $gambarfile = $gambars->getClientOriginalName();
                $gambars->move($tujuan, $gambarfile);
                $post['gambar'] = $gambarfile;
            }
        } else {
            if ($gambars = $request->file('gambar')) {
                $tujuan = 'gambar/buku/';
                $gambarfile = $gambars->getClientOriginalName();
                $gambars->move($tujuan, $gambarfile);
                $post['gambar'] = $gambarfile;
            }
        }
        $buku = Buku::updateOrCreate(['id' => $id], $post);
        return response()->json($buku);
    }
    public function edit($id)
    {
        $post = Buku::where('id', $id)->first();
        return response()->json($post);
    }
    public function delete($id)
    {
        $post = Buku::where('id', $id)->delete();
        return response()->json($post);
    }
    public function show($id)
    {
        $title = 'Detail Buku';
        $data = Buku::find($id);
        return view('admin.buku.detail', compact('data', 'title'));
    }
    public function print()
    {
        $data = Buku::all();
        $pdf = PDF::loadview('admin.buku.print', compact('data'))->setPaper('a4', 'Landscape');
        return $pdf->stream();
    }
}
