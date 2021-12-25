<?php

namespace App\Models\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;
    protected $table = 'transaksi';
    protected $guarded = [];

    public function buku()
    {
        return $this->belongsTo(Buku::class);
    }
    public function anggota()
    {
        return $this->belongsTo(Anggota::class);
    }
    public function get_data_anggota($kode_anggota)
    {
        $hsl = Anggota::where('kode_anggota', $kode_anggota);
        if ($hsl->num_rows() > 0) {
            foreach ($hsl->result() as $data) {
                $hasil = array(
                    'kode_anggota' => $data->kode_anggota,
                    'nama' => $data->nama,
                );
            }
        }
        return $hasil;
    }
}
