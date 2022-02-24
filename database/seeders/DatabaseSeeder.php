<?php

namespace Database\Seeders;

use App\Models\Kepsek;
use App\Models\Model\Admin;
use App\Models\Model\Anggota;
use App\Models\Model\Level;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $this->call(KlasifikasiSeeder::class);
        $this->call(PenerbitSeeder::class);
        Admin::create([
            'nama' => 'Kepsek',
            'username' => 'kepsek',
            'level' => 'Kepsek',
            'password' => \bcrypt('kepsek')
        ]);
        Admin::create([
            'nama' => 'Admin',
            'username' => 'admin',
            'level' => 'Apkepdmin',
            'password' => \bcrypt('admin')
        ]);
        Level::create(['level' => 'Siswa']);
        Level::create(['level' => 'Guru']);
        Level::create(['level' => 'Staff']);
        Anggota::create([
            'kode_anggota' => 'AG00001',
            'username' => 'anggota',
            'password' => \bcrypt('anggota'),
            'nama' => 'Anggota',
            'level_id' => '1',
            'tempat_lahir' => 'Jambi',
            'tgl_lahir' => today(),
            'jk' => 'L',
            'alamat' => 'jambi',
            'no_hp' => '09899899',

        ]);
        $this->call(AnggotaSeeder::class);
        $this->call(BukuSeeder::class);
    }
}
