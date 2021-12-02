<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\Model\Transaksi;
use Illuminate\Http\Request;
use PDF;

class DendaController extends Controller
{
    public function index(Request $request)
    {
        $title = 'Denda';
        $list_transaksi = Transaksi::whereIn('status_denda', ['Belum Lunas', 'Lunas'])->get();
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
                    if ($data->status_denda == 'Belum Lunas') {
                        $button = '<a href="/admin/denda/' . $data->id . '/lunasi" type="button" name="kembalikan"  class="kembalikan btn btn-success btn-xs"><i class="fa fa-money"></i></a>';
                        return $button;
                    } else {
                        $button = '<a href="/admin/denda/' . $data->id . '/cetak" type="button" name="kembalikan"  class="kembalikan btn btn-warning btn-xs"><i class="fa fa-print"></i></a>';
                        return $button;
                    }
                })
                ->addColumn('tgl_kembali', function ($data) {
                    return date('d F Y', strtotime($data->tgl_kembali));
                })
                ->addColumn('tgl_pinjam', function ($data) {
                    return date('d F Y', strtotime($data->tgl_pinjam));
                })
                ->addColumn('denda', function ($data) {
                    return '<span class="label label-danger">' . 'Rp ' . number_format($data->denda, 0) . ' <i class="fa fa-times">' . '</span>';
                })
                ->rawColumns(['denda', 'status_denda', 'nama', 'judul_buku', 'action', 'tgl_kembali', 'tgl_pinjam'])
                ->make(true);
        }
        return view('admin.denda.index', compact('title'));
    }
    public function lunasi($id)
    {
        Transaksi::findOrFail($id);
        Transaksi::where('id', $id)->update(['status_denda' => 'Lunas']);
        return redirect()->back()->with('sukses', 'Denda Berhasi dilunasi');
    }
    public function cetak($id)
    {
        $tgl = date('d F Y');
        // $tgl = date('F - d - y');
        $data = Transaksi::find($id);
        $pdf = PDF::loadview('admin.denda.kwitansi', compact('data', 'tgl'))->setPaper('a5', 'landscape');
        return $pdf->stream('kwitansi' . date('Y-m-d_H:i:s') . '.pdf');
    }
}
