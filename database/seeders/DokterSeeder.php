<?php

namespace Database\Seeders;

use App\Models\Dokter;
use App\Models\Poli;
use App\Traits\AppConfig;
use Faker\Factory;
use Illuminate\Database\Seeder;

class DokterSeeder extends Seeder
{
    use AppConfig;

    private int $maxPolisPerDoctor = 3;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create('id_ID');
        $poli = Poli::get();
        $password = bcrypt($this->getDefaultPassword());


        $data = [];
        foreach ($poli as $key => $value) {
            $data[] = [
                'nama' => $faker->name,
                'alamat' => $faker->address,
                'no_hp' => $faker->phoneNumber,
                'id_poli' => $value->id,
                'password' => $password
            ];

        }

        Dokter::insert($data);
    }
}
