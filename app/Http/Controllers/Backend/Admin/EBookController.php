<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\Model\EBook;
use App\Models\Model\Klasifikasi;
use App\Models\Model\Penerbit;
use Illuminate\Http\Request;
use File;

class EBookController extends Controller
{
    public function index(Request $request)
    {
        $title = 'Data E-Book';
        $klasifikasi = Klasifikasi::get();
        $kelas = ['Umum', 'VII', 'VIII', 'IX'];
        $penerbit = Penerbit::get();
        $ebook = EBook::all();

        return view('admin.ebook.index', compact('title', 'kelas', 'klasifikasi', 'penerbit'));
    }
    public function ajax(Request $request)
    {
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
                    $button = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $data->id . '" data-original-title="Edit" class="btn btn-warning btn-xs edit-post"><i class="lnr lnr-pencil"></i> </a>';
                    $button .= '&nbsp;&nbsp;';
                    $button .= '<button type="button" name="delete" id="' . $data->id . '"  class="delete btn btn-danger btn-xs"><i class="lnr lnr-trash"></i></button>';
                    $button .= '&nbsp;&nbsp;';
                    $button .= '<a href="/admin/e-book/' . $data->id . '/show"  class="btn btn-success btn-xs"><i class="fa fa-search"></I></a>';
                    return $button;
                })
                ->addColumn('gambar', function ($data) {
                    $gambar = '<img src="' . $data->getGambar() . '"" width="100" height="100"
                                            class="rounded-circle">';
                    return  $gambar;
                })->rawColumns(['action', 'klasifikasi', 'penerbit', 'gambar'])
                ->make(true);
        }
    }
    public function store(Request $request)
    {
        request()->validate([
            'file' => 'file|mimes:pdf,doc,docx|max:51200',
        ]);
        $id = $request->id;
        $post =
            [
                'judul_buku' => $request->judul_buku,
                // 'file' => $request->file,
                'kelas' => $request->kelas,
                'tahun_terbit' => $request->tahun_terbit,
                'penulis' => $request->penulis,
                'penerbit_id' => $request->penerbit_id,
                'klasifikasi_id' => $request->klasifikasi_id,
            ];
        if ($id != null) {
            if ($gambars = $request->file('gambar')) {
                $gambar = EBook::where('id', $request->id)->first();
                File::delete('gambar/e-book/' . $gambar->gambar);
                $tujuan = 'gambar/e-book/';
                $gambarfile = $gambars->getClientOriginalName();
                $gambars->move($tujuan, $gambarfile);
                $post['gambar'] = $gambarfile;
            }
        } else {
            if ($gambars = $request->file('gambar')) {
                $tujuan = 'gambar/e-book/';
                $gambarfile = $gambars->getClientOriginalName();
                $gambars->move($tujuan, $gambarfile);
                $post['gambar'] = $gambarfile;
            }
        }
        if ($id != null) {
            if ($files = $request->file('file')) {
                $file = EBook::where('id', $request->id)->first();
                File::delete('file/' . $file->file);
                $destinationPath = 'file/';
                $profilFile = $files->getClientOriginalName();
                $files->move($destinationPath, $profilFile);
                $post['file'] = "$profilFile";
            }
        } else {
            if ($files = $request->file('file')) {
                $destinationPath = 'file/';
                $profilFile = $files->getClientOriginalName();
                $files->move($destinationPath, $profilFile);
                $post['file'] = "$profilFile";
            }
        }

        $ebook = EBook::updateOrCreate(['id' => $id], $post);
        return response()->json($ebook);
    }
    public function edit($id)
    {
        $post = EBook::where('id', $id)->first();
        return response()->json($post);
    }
    public function delete($id)
    {

        $data = EBook::where('id', $id)->first();
        FIle::delete('file/' . $data->file);
        $post = EBook::where('id', $id)->delete();
        return response()->json($post);
    }
    public function show($id)
    {
        $data = EBook::find($id);
        $title = "Buku " . $data->judul_buku . " Kelas " . $data->kelas;
        return view('admin.ebook.detail', compact('data', 'title'));
    }
}
