<?php

namespace Database\Seeders;

use App\Models\Obat;
use Faker\Factory;
use Illuminate\Database\Seeder;

class ObatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $obat = [
            'Paracetamol',
            'Amoxilin',
            'Cefadroxil',
            'Cefixime',
            'Ceftriaxone',
            'Cefotaxime',
            'Cefoperazone',
            'Cefpirome',
            'Ceftazidime',
            'Ceftibuten',
            'Ceftizoxime',
            'Cefuroxime',
            'Cefaclor',
            'Cefadroxil',
            'Cefalexin',
            'Cefatrizine',
            'Cefazolin',
            'Cefdinir',
            'Cefditoren',
            'Cefepime',
            'Cefetamet'
        ];
        $faker = Factory::create('id_ID');
        $data = [];
        foreach ($obat as $key => $value) {
            $data[] = [
                'nama_obat' => $value,
                'kemasan' => ucfirst($faker->randomElement(['botol', 'strip', 'kapsul', 'tablet'])),
                'harga' => random_int(1000, 2000)
            ];
        }

        Obat::insert($data);
    }
}
