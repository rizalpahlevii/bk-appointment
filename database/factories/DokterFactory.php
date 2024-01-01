<?php

namespace Database\Factories;

use App\Models\Dokter;
use App\Models\Poli;
use Illuminate\Database\Eloquent\Factories\Factory;

class DokterFactory extends Factory
{
    protected $model = Dokter::class;

    public function definition(): array
    {
        return [
            'nama' => $this->faker->word(),
            'password' => bcrypt($this->faker->password()),
            'alamat' => $this->faker->word(),
            'no_hp' => $this->faker->word(),
            'id_poli' => Poli::factory()
        ];
    }
}
