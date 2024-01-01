<?php

namespace Tests\Feature\Daftar;

use Faker\Factory;
use Tests\TestCase;

class DaftarTest extends TestCase
{
    public function test_daftar_page()
    {
        $this->get(route('daftar.index'))
            ->assertStatus(200);
    }

    public function test_daftar(): void
    {
        $faker = Factory::create('id_ID');
        $this->post(route('daftar.store'), [
            'nama' => $nama = $faker->name,
            'no_ktp' => $noKtp = $faker->nik,
            'no_hp' => $noHp = $faker->phoneNumber,
            'alamat' => $alamat = $faker->address,
            'password' => $password = $faker->password(10),
            'password_konfirmasi' => $password,
        ]);

        $this->assertDatabaseHas('pasien', [
            'nama' => $nama,
            'no_hp' => $noHp,
            'no_ktp' => $noKtp,
            'alamat' => $alamat
        ]);


    }
}
