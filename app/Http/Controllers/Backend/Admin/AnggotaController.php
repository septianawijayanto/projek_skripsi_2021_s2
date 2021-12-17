<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\Model\Anggota;
use App\Models\Model\Level;
use PDF;
use Illuminate\Http\Request;

class AnggotaController extends Controller
{
    public function index()
    {
        $title = 'Data Anggota';

        $getRow = Anggota::orderBy('id', 'DESC')->get();
        $rowCount = $getRow->count();

        $lastId = $getRow->first();

        $kode = "AG00001";

        if ($rowCount > 0) {
            if ($lastId->id < 9) {
                $kode = "AG0000" . '' . ($lastId->id + 1);
            } else if ($lastId->id < 99) {
                $kode = "AG000" . '' . ($lastId->id + 1);
            } else if ($lastId->id < 999) {
                $kode = "AG00" . '' . ($lastId->id + 1);
            } else if ($lastId->id < 9999) {
                $kode = "AG0" . '' . ($lastId->id + 1);
            } else {
                $kode = "AG" . '' . ($lastId->id + 1);
            }
        }
        $level = Level::get();
        return view('admin.anggota.index', compact('title', 'level', 'kode'));
    }
    public function ajax(Request $request)
    {

        $list_anggota = Anggota::all();
        if ($request->ajax()) {
            return datatables()->of($list_anggota)->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $button = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $data->id . '" data-original-title="Edit" class="btn btn-warning btn-xs edit-post"><i class="lnr lnr-pencil"></i> </a>';
                    $button .= '&nbsp;&nbsp;';
                    $button .= '<button type="button" name="delete" id="' . $data->id . '"  class="delete btn btn-danger btn-xs"><i class="lnr lnr-trash"></i></button>';
                    return $button;
                })->addColumn('level', function ($data) {
                    return $data->level->level;
                })
                ->rawColumns(['action', 'level'])
                ->make(true);
        }
    }
    public function delete($id)
    {
        $post = Anggota::where('id', $id)->delete();
        return response()->json($post);
    }
    public function store(Request $request)
    {
        $id = $request->id;
        $post = Anggota::updateOrCreate(
            ['id' => $id],
            [
                'kode_anggota' => $request->kode_anggota,
                'nama' => $request->nama,
                'username' => $request->username,
                'level_id' => $request->level_id,
                'password' => \bcrypt($request->password),
                'tempat_lahir' => $request->tempat_lahir,
                'tgl_lahir' => $request->tgl_lahir,
                'jk' => $request->jk,
                'alamat' => $request->alamat,
                'no_hp' => $request->no_hp,
            ]
        );
        return response()->json($post);
    }
    public function edit($id)
    {
        $where = array('id' => $id);
        $post = Anggota::where($where)->first();
        return response()->json($post);
    }
    public function print()
    {
        $tgl = date('d F Y');
        $data = Anggota::all();
        $pdf = PDF::loadview('admin.anggota.print', compact('data', 'tgl'))->setPaper('a4', 'Landscape');
        return $pdf->stream();
    }
}
