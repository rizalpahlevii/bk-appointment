<?php

namespace Database\Seeders;

use App\Models\Pasien;
use Illuminate\Database\Seeder;

class PasienSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Pasien::create([
            'nama' => 'rizal',
            'alamat' => 'Jl. Raya',
            'no_hp' => '081234567890',
            'no_ktp' => '1234567890123456',
            'no_rm' => '1234567890',
        ]);
    }
}
