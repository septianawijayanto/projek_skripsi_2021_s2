<?php

namespace App\Models\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;
    protected $table = 'buku';
    protected $guarded = [];

    public function klasifikasi()
    {
        return $this->belongsTo(Klasifikasi::class);
    }
    public function penerbit()
    {
        return $this->belongsTo(Penerbit::class);
    }
    public function getGambar()
    {
        if (!$this->gambar) {
            return asset('gambar/buku/buku.png');
        }
        return asset('gambar/buku/' . $this->gambar);
    }
}
