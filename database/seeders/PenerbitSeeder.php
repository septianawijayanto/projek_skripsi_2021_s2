<?php

namespace Database\Seeders;

use App\Models\Model\Penerbit;
use Illuminate\Database\Seeder;

class PenerbitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Penerbit::create([
            'kode_penerbit' => 'PNB00001',
            'nama_penerbit' => 'Yudistira',
            'alamat' => 'Jakarta',
            'no_telp' => '08990098'
        ]);
    }
}
