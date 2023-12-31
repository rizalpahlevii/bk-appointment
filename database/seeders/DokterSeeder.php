<?php

namespace Database\Seeders;

use App\Models\Dokter;
use App\Models\Poli;
use Faker\Factory;
use Illuminate\Database\Seeder;

class DokterSeeder extends Seeder
{
    private array $poli = [
        'umum',
        'gigi',
        'mata',
        'jantung',
        'paru',
        'kulit',
        'tulang',
        'syaraf',
        'telinga',
        'hidung',
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Dokter::truncate();
        Poli::truncate();

        $faker = Factory::create('id_ID');
        foreach ($this->poli as $i => $iValue) {
            Poli::create([
                'nama_poli' => ucfirst($this->poli[$i]),
                'keterangan' => $faker->sentence,
            ]);
        }

        for ($i = 0; $i < random_int(30, 40); $i++) {
            $dokter = Dokter::create([
                'nama' => $faker->name,
                'alamat' => $faker->address,
                'no_hp' => $faker->phoneNumber,
                'id_poli' => Poli::inRandomOrder()->first()->id,
            ]);
        }

    }
}
