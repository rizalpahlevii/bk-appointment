<?php

namespace Database\Seeders;

use App\Models\Poli;
use Faker\Factory;
use Illuminate\Database\Seeder;

class PoliSeeder extends Seeder
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
        $faker = Factory::create('id_ID');
        foreach ($this->poli as $i => $iValue) {
            Poli::create([
                'nama_poli' => ucfirst($this->poli[$i]),
                'keterangan' => $faker->sentence,
            ]);
        }
    }
}
