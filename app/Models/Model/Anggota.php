<?php

namespace App\Models\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    use HasFactory;
    protected $table = 'anggota';
    protected $guarded = [];
    // protected $fillable = ['id', 'nama', 'username','password','level', 'tgl_lahir', 'alamat', 'agama'];
    public function level()
    {
        return $this->belongsTo(Level::class);
    }
}
