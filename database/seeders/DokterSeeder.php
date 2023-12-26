<?php

namespace Database\Seeders;

use App\Models\Dokter;
use App\Models\Poli;
use Illuminate\Database\Seeder;

class DokterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $poli = Poli::create([
            'nama_poli' => 'umum',
            'keterangan' => 'poli umum',
        ]);
        Dokter::create([
            'nama' => 'rizal',
            'alamat' => 'Jl. Raya',
            'no_hp' => 212121212,
            'id_poli' => $poli->id,
        ]);
    }
}
