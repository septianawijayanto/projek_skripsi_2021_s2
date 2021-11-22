<?php

namespace Database\Seeders;

use App\Models\Model\Klasifikasi;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KlasifikasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Klasifikasi::create([
            'kode_klasifikasi' => '0',
            'nama_klasifikasi' => 'Publikasi Umum'
        ]);
    }
}
