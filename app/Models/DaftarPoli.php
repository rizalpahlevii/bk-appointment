<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DaftarPoli extends Model
{

    public $timestamps = false;

    protected $table = 'daftar_poli';

    protected $fillable = [
        'id_pasien',
        'id_jadwal',
        'keluhan',
        'no_antrian',
    ];

    public static function generateNoAntrian(mixed $input): int
    {
        return 1;
//        $lastAntrian = self::where('id_jadwal', $input)->orderBy('id', 'desc')->first();
//        if (!$lastAntrian) {
//            return 1;
//        }
//        $lastId = $lastAntrian->no_antrian;
//        $lastId = explode('-', $lastId)[1];
//        $lastId = (int)$lastId;
//        $lastId++;
//        return $lastId;
    }

    public function pasien()
    {
        return $this->belongsTo(Pasien::class, 'id_pasien');
    }

    public function jadwal()
    {
        return $this->belongsTo(JadwalPeriksa::class, 'id_jadwal');
    }

    public function periksa()
    {
        return $this->hasOne(Periksa::class, 'id_daftar_poli');
    }
}
