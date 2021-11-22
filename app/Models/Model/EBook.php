<?php

namespace App\Models\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EBook extends Model
{
    use HasFactory;
    protected $table = 'e_book';
    protected $guarded = [];
    public function klasifikasi()
    {
        return $this->belongsTo(Klasifikasi::class);
    }
    public function penerbit()
    {
        return $this->belongsTo(Penerbit::class);
    }
    public function getFile()
    {

        return asset('file/' . $this->file);
    }
    public function getGambar()
    {
        if (!$this->gambar) {
            return asset('gambar/e-book/buku.png');
        }
        return asset('gambar/e-book/' . $this->gambar);
    }
}
