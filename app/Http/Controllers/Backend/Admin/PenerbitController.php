<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\Model\Penerbit;
use Illuminate\Http\Request;

class PenerbitController extends Controller
{
    public function index()
    {
        $title = 'Data Penerbit';
        $kode = "PNB00001";

        $getRow = Penerbit::orderBy('id', 'DESC')->get();
        $rowCount = $getRow->count();

        $lastId = $getRow->first();

        $kode = "PNB00001";

        if ($rowCount > 0) {
            if ($lastId->id < 9) {
                $kode = "PNB0000" . '' . ($lastId->id + 1);
            } else if ($lastId->id < 99) {
                $kode = "PNB000" . '' . ($lastId->id + 1);
            } else if ($lastId->id < 999) {
                $kode = "PNB00" . '' . ($lastId->id + 1);
            } else if ($lastId->id < 9999) {
                $kode = "PNB0" . '' . ($lastId->id + 1);
            } else {
                $kode = "PNB" . '' . ($lastId->id + 1);
            }
        }

        return view('admin.penerbit.index', compact('title'));
    }
    public function ajax(Request $request)
    {
        $list_penerbit = Penerbit::all();
        if ($request->ajax()) {

            return datatables()->of($list_penerbit)->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $button = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $data->id . '" data-original-title="Edit" class="btn btn-warning btn-xs edit-post"><i class="lnr lnr-pencil"></i> </a>';
                    $button .= '&nbsp;&nbsp;';
                    $button .= '<button type="button" name="delete" id="' . $data->id . '"  class="delete btn btn-danger btn-xs"><i class="lnr lnr-trash"></i></button>';
                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        //  return response()->json($list_penerbit);
    }
    public function store(Request $request)
    {
        $id = $request->id;
        $post = Penerbit::updateOrCreate(
            ['id' => $id],
            [
                'kode_penerbit' => $request->kode_penerbit,
                'nama_penerbit' => $request->nama_penerbit,
                'alamat' => $request->alamat,
                'no_telp' => $request->no_telp,
            ],
        );
        return response()->json($post);
    }
    public function edit($id)
    {
        $post = Penerbit::where('id', $id)->first();
        return response()->json($post);
    }
    public function delete($id)
    {
        $post = Penerbit::where('id', $id)->delete();
        return response()->json($post);
    }
}
