<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\Model\Sekolah;
use Illuminate\Http\Request;
use File;
use Validator;

class SekolahController extends Controller
{
    public function index()
    {
        $title = 'Sekolah';
        return view('admin.sekolah.index', compact('title'));
    }
    public  function store(Request $request)
    {
        // $validasi = Validator::make($request->all(), [
        //     'logo' => 'logo|mimes:jpg,jpeg,png',
        //     'logo_sekolah' => 'logo_sekolah|mimes:jpg,jpeg,png',
        //     'logo_kab' => 'logo_kab|mimes:jpg,jpeg,png',

        // ]);
        // if (!$validasi->passes()) {
        //     return response()->json(['eror' => $validasi->errors()->all()]);
        // } else {
        $data = [
            'nama_sekolah' => $request->nama_sekolah,
            'alamat' => $request->alamat,
            'kode_pos' => $request->kode_pos,
            'desa' => $request->desa,
            'kecamatan' => $request->kecamatan,
            'kabupaten' => $request->kabupaten,
            'provinsi' => $request->provinsi,
            'email' => $request->email,
            'website' => $request->website,
            'no_telp' => $request->no_telp,
        ];
        if ($logos = $request->file('logo')) {
            $destinationPath = 'logo/';
            $logofile = $logos->getClientOriginalName();
            $logos->move($destinationPath, $logofile);
            $data['logo'] = "$logofile";
        }
        if ($logo_sekolahs = $request->file('logo_sekolah')) {
            $destinationPath2 = 'logo/';
            $logosse = $logo_sekolahs->getClientOriginalName();
            $logo_sekolahs->move($destinationPath2, $logosse);
            $data['logo_sekolah'] = "$logosse";
        }
        if ($logo_kabs = $request->file('logo_kab')) {
            // $logo_kab = Sekolah::where('id', $request->id)->first();
            // File::delete('logo/' . $logo_kab->file);
            $destinationPath3 = 'logo/';
            $logok = $logo_kabs->getClientOriginalName();
            $logo_kabs->move($destinationPath3, $logok);
            $data['logo_kab'] = "$logok";
        }
        $sekolah = Sekolah::Create($data);
        return response()->json($sekolah);
        // }
    }
}
