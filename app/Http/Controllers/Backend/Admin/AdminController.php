<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\Model\Admin;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $title = 'Data Admin ';
        $list_klasifikasi = Admin::where('level', 'Admin')->get();
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
        return view('admin.admin.index', compact('title'));
    }
    public function store(Request $request)
    {
        $id = $request->id;
        $post = Admin::updateOrCreate([
            'id' => $id
        ], [
            'nama' => $request->nama,
            'username' => $request->username,
            'level' => 'Admin',
            'password' => bcrypt($request->password),
        ]);
        return response()->json($post);
    }
    public function edit($id)
    {
        $post = Admin::where('id', $id)->first();
        return response()->json($post);
    }
    public function delete($id)
    {
        $post = Admin::where('id', $id)->delete();
        return response()->json($post);
    }
}
