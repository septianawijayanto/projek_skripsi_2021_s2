<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\Model\Klasifikasi;
use Illuminate\Http\Request;

class KlasifikasiController extends Controller
{
    public function index(Request $request)
    {
        $title = 'Data Klasifikasi ';
        $list_klasifikasi = Klasifikasi::all();
        if ($request->ajax()) {
            return datatables()->of($list_klasifikasi)->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $button = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $data->id . '" data-original-title="Edit" class="btn btn-warning btn-xs edit-post"><i class="lnr lnr-pencil"></i> </a>';
                    $button .= '&nbsp;&nbsp;';
                    $button .= '<button type="button" name="delete" id="' . $data->id . '"  class="delete btn btn-danger btn-xs"><i class="lnr lnr-trash"></i></button>';
                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.klasifikasi.index', compact('title'));
    }
    public function store(Request $request)
    {
        $id = $request->id;
        $post = Klasifikasi::updateOrCreate([
            'id' => $id
        ], [
            'kode_klasifikasi' => $request->kode_klasifikasi,
            'nama_klasifikasi' => $request->nama_klasifikasi
        ]);
        return response()->json($post);
    }
    public function edit($id)
    {
        $post = Klasifikasi::where('id', $id)->first();
        return response()->json($post);
    }
    public function delete($id)
    {
        $post = Klasifikasi::where('id', $id)->delete();
        return response()->json($post);
    }
}
