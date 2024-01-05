<?php

namespace Database\Seeders;

use App\Models\Dokter;
use App\Models\JadwalPeriksa;
use Faker\Factory;
use Illuminate\Database\Seeder;

class JadwalPeriksaSeeder extends Seeder
{
    private array $scheduleList = [
        'Senin' => [
            ['08:00:00', '10:00:00'],
            ['10:00:00', '12:00:00'],
            ['13:00:00', '15:00:00'],
            ['15:00:00', '17:00:00'],
        ],
        'Selasa' => [
            ['08:00:00', '10:00:00'],
            ['10:00:00', '12:00:00'],
            ['13:00:00', '15:00:00'],
            ['15:00:00', '17:00:00'],
        ],
        'Rabu' => [
            ['08:00:00', '10:00:00'],
            ['10:00:00', '12:00:00'],
            ['13:00:00', '15:00:00'],
            ['15:00:00', '17:00:00'],
        ],
        'Kamis' => [
            ['08:00:00', '10:00:00'],
            ['10:00:00', '12:00:00'],
            ['13:00:00', '15:00:00'],
            ['15:00:00', '17:00:00'],
        ],
        'Jumat' => [
            ['08:00:00', '10:00:00'],
            ['10:00:00', '12:00:00'],
            ['13:00:00', '15:00:00'],
            ['15:00:00', '17:00:00'],
        ],
        'Sabtu' => [
            ['08:00:00', '10:00:00'],
            ['10:00:00', '12:00:00'],
            ['13:00:00', '15:00:00'],
            ['15:00:00', '17:00:00'],
        ],
    ];

    private $dayList = [
        'Senin',
        'Selasa',
        'Rabu',
        'Kamis',
        'Jumat',
        'Sabtu'
    ];

    private int $maxSchedulePerDoctor = 3;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create('id_ID');
        $dokter = Dokter::select('id')->get();
        $data = [];

        foreach ($dokter as $key => $row) {
            $day = $faker->randomElement($this->dayList, 1);
            $schedule = $faker->randomElement($this->scheduleList[$day]);
            $data[] = [
                'id_dokter' => $row->id,
                'hari' => $day,
                'jam_mulai' => $schedule[0],
                'jam_selesai' => $schedule[1],
            ];
        }

        JadwalPeriksa::insert($data);

    }
}
