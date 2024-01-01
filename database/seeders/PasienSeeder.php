<?php

namespace Database\Seeders;

use App\Models\Pasien;
use App\Traits\AppConfig;
use Faker\Factory;
use Illuminate\Database\Seeder;

class PasienSeeder extends Seeder
{
    use AppConfig;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create('id_ID');
        $password = bcrypt($this->getDefaultPassword());
        for ($i = 0; $i < 10; $i++) {
            $data[] = [
                'nama' => $faker->name,
                'password' => $password,
                'alamat' => $faker->address,
                'no_ktp' => $faker->nik,
                'no_hp' => $faker->phoneNumber,
                'no_rm' => date('Ym') . '-' . sprintf('%03d', $i + 1),
            ];
        }
        Pasien::insert($data);
    }
}
