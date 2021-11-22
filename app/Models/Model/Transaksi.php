<?php

namespace App\Models\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;
    protected $table='transaksi';
    protected $guarded=[];

    public function buku(){
        return $this->belongsTo(Buku::class);
    }
    public function anggota(){
        return $this->belongsTo(Anggota::class);
    }
}
