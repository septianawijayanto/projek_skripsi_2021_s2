<?php

namespace App\Http\Controllers\Backend\Auth;

use App\Http\Controllers\Controller;
use App\Models\Model\Admin;
use App\Models\Model\Anggota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use PhpOffice\PhpSpreadsheet\Shared\Trend\Trend;

class LoginController extends Controller
{
    public function index()
    {
        if (Session::has('login_sebagai')) {
            if (Session::get('login_sebagai') == 'admin') {
                return redirect('admin/dashboard');
            } else {
                return redirect('anggota/dashboard');
            }
        }
        return view('auth.login');
    }
    public function logout()
    {
        Session::flush();
        return redirect('login')->with('sukses', 'Anda Berhasil Keluar Dari Sistem');
    }
    public function postlogin(Request $request)
    {
        // dd($request->all());
        $username = $request->username;
        $password = $request->password;
        $loginSebagai = $request->masuk_sebagai;
        if ($loginSebagai == 'admin') {
            $data = Admin::where('username', $username)->first();
            if ($data) { //apakah username tersebut ada atau tidak
                if (Hash::check($password, $data->password)) {
                    Session::put('id', $data->id);
                    Session::put('nama', $data->nama);
                    Session::put('username', $data->username);
                    Session::put('login_sebagai', 'admin');
                    Session::put('login', TRUE);
                    return redirect('admin/dashboard')->with('sukses', 'Anda Berhasil Masuk Ke Sistem');
                }
            }
            return redirect('login')->with('gagal', 'Username atau password salah !');
        } else {
            $data = Anggota::where('username', $username)->first();
            if ($data) {
                if (Hash::check($password, $data->password)) {
                    Session::put('id', $data->id);
                    Session::put('nama', $data->nama);
                    Session::put('username' . $data->username);
                    Session::put('level', $data->level);
                    Session::put('tgl_lahir', $data->tgl_lahir);
                    Session::put('agama', $data->agama);
                    Session::put('alamat', $data->alamat);
                    Session::put('login_sebagai', 'anggota');
                    Session::put('login', TRUE);
                    return \redirect('anggota/dashboard')->with('sukses', 'Anda Berhasil Masuk Ke Sistem');
                }
            }
            return \redirect('login')->with('gagal', 'Username atau password salah !');
        }
    }
    public function cek_username(Request $request)
    {
        $countUser = Admin::where('username', $request->username)->count();
        if ($countUser >= 1) {
            return response()->json(['success' => 'Username Anda Benar']);
        } else {
            return response()->json(['error' => 'Maaf user not found!']);
        }
    }
}
