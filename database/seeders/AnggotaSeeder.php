<?php

namespace Database\Seeders;

use App\Models\Model\Anggota;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class AnggotaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        foreach (range(1, 15) as $value) {
            Anggota::insert([
                'username' => $faker->firstName(),
                'password' => \bcrypt('123'),
                'nama' => $faker->name,
                'level_id' => $faker->randomElement(['1', '2', '3']),
                'tempat_lahir' => $faker->city,
                'tgl_lahir' => $faker->date($format = 'Y-m-d', $max = 'now'),
                'jk' => $faker->randomElement(['L', 'P']),
                'alamat' => $faker->secondaryAddress,
                'no_hp' => $faker->phoneNumber,
            ]);
        }
        // $anggota = Anggota::factory()->count(3)->make();
    }
}
