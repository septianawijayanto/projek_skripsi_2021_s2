<?php

namespace Database\Seeders;

use App\Models\Model\Buku;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class BukuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        foreach (range(1, 105) as $value) {
            Buku::create([
                'kode' => '',
                'gambar' => 'Sekolah-Tinggi-Ilmu-Komputer-Dinamika-Bangsa.png',
                'penerbit_id' => '1',
                'klasifikasi_id' => '1',
                'judul_buku' => $faker->firstName(),
                'penulis' => $faker->firstName(),
                'kelas' => $faker->randomElement(['Umum', 'VII', 'VIII', 'IX']),
                'tahun_terbit' => $faker->year(),
                'tahun_pengadaan' => $faker->year(),
                'jumlah' => '100',
                'jml_dipinjam' => 0,
                'rusak' => 0,
                'hilang' => 0,
                'sumber_dana' => $faker->randomElement(['BOS', 'DAK']),
                'status' => 1,
            ]);
        }
        // $faker = Faker::create();
        // foreach (range(1, 15) as $value) {
        //     Anggota::insert([
        //         'kode_anggota' => $faker->firstName(),
        //         'username' => $faker->firstName(),
        //         'password' => \bcrypt('123'),
        //         'nama' => $faker->name,
        //         'level_id' => $faker->randomElement(['1', '2', '3']),
        //         'tempat_lahir' => $faker->city,
        //         'tgl_lahir' => $faker->date($format = 'Y-m-d', $max = 'now'),
        //         'jk' => $faker->randomElement(['L', 'P']),
        //         'alamat' => $faker->secondaryAddress,
        //         'no_hp' => $faker->phoneNumber,
        //     ]);
        // }
    }
}
