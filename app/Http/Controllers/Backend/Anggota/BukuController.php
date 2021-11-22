<?php

namespace App\Http\Controllers\Backend\Anggota;

use App\Http\Controllers\Controller;
use App\Models\Model\Buku;
use App\Models\Model\EBook;
use Illuminate\Http\Request;

class BukuController extends Controller
{
    public function bindex(Request $request)
    {
        $title = 'Buku';
        $list_buku = Buku::all();
        if ($request->ajax()) {
            return datatables()->of($list_buku)->addIndexColumn()
                ->addColumn('penerbit', function ($data) {
                    return $data->penerbit->nama_penerbit;
                })
                ->addColumn('klasifikasi', function ($data) {
                    return $data->klasifikasi->nama_klasifikasi;
                })->addColumn('gambar', function ($data) {
                    $gambar = '<img src="' . $data->getGambar() . '"" width="100" height="100"
                                            class="rounded-circle">';
                    return  $gambar;
                })
                ->rawColumns(['penerbit', 'klasifikasi', 'gambar'])
                ->make(true);
        }
        return view('anggota.buku.buku-index', compact('title'));
    }
    public function eindex(Request $request)
    {
        $title = 'E-book';
        $ebook = EBook::all();
        if ($request->ajax()) {

            return datatables()->of($ebook)->addIndexColumn()
                ->addColumn('klasifikasi', function ($data) {
                    return $data->klasifikasi->nama_klasifikasi;
                })
                ->addColumn('penerbit', function ($data) {
                    return $data->penerbit->nama_penerbit;
                })
                ->addColumn('action', function ($data) {

                    $button = '<a href="/anggota/ebook/' . $data->id . '/show"  class="btn btn-primary btn-xs"><i class="fa fa-book"></I></a>';
                    return $button;
                })->addColumn('gambar', function ($data) {
                    $gambar = '<img src="' . $data->getGambar() . '"" width="100" height="100"
                                            class="rounded-circle">';
                    return  $gambar;
                })->rawColumns(['action', 'klasifikasi', 'penerbit', 'gambar'])
                ->make(true);
        }
        return view('anggota.buku.ebook-index', compact('title'));
    }
    public function show($id)
    {
        $data = EBook::find($id);
        $title = "Buku " . $data->judul_buku . " Kelas " . $data->kelas;
        return view('anggota.buku.show', compact('title', 'data'));
    }
}
