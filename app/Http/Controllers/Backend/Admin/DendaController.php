<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\Model\Transaksi;
use Illuminate\Http\Request;

class DendaController extends Controller
{
    public function index(Request $request)
    {
        $title = 'Denda';
        $list_transaksi = Transaksi::where('status_denda', 'denda')->get();
        if ($request->ajax()) {
            return datatables()->of($list_transaksi)->addIndexColumn()
                ->addColumn('status_denda', function ($data) {
                    if ($data->status_denda == 'Belum Lunas') {
                        $badge =   '<span class="label label-danger">' . $data->status_denda . '</span>';
                        return   $badge;
                    } elseif ($data->status_denda == 'Lunas') {
                        $badge =   '<span class="label label-success">' . $data->status_denda . '</span>';
                        return   $badge;
                    }
                })
                ->addColumn('nama', function ($data) {
                    return $data->anggota->nama;
                })
                ->addColumn('judul_buku', function ($data) {
                    return $data->buku->judul_buku;
                })
                ->addColumn('action', function ($data) {
                    $button = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $data->id . '" data-original-title="Edit" class="btn btn-warning btn-xs edit-post"><i class="lnr lnr-pencil"></i> </a>';
                    // $button .= '&nbsp;';
                    // $button .= '<a href="/transaksi/' . $data->id . '/kembali" type="button" name="kembalikan"  class="kembalikan btn btn-primary btn-xs"><i class="lnr lnr-trash"></i></a>';
                    return $button;
                })
                ->addColumn('tgl_kembali', function ($data) {
                    return date('d F Y, H:i', strtotime($data->tgl_kembali));
                })
                ->addColumn('tgl_pinjam', function ($data) {
                    return date('d F Y, H:i', strtotime($data->tgl_pinjam));
                })
                ->addColumn('denda', function ($data) {
                    return '<span class="label label-danger">' . 'Rp ' . number_format($data->denda, 0) . ' <i class="fa fa-times">' . '</span>';
                })
                ->rawColumns(['denda', 'status_denda', 'nama', 'judul_buku', 'action', 'tgl_kembali', 'tgl_pinjam'])
                ->make(true);
        }
        return view('admin.denda.index', compact('title'));
    }
}
