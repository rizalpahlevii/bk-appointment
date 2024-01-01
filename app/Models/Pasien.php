<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Pasien extends Authenticatable
{
    public $timestamps = false;

    protected $table = 'pasien';

    protected $fillable = [
        'nama', 'alamat', 'no_ktp', 'no_hp', 'no_rm', 'password'
    ];

    public static function generateRM(): string
    {
        $lastPasien = self::orderBy('id', 'desc')->first();
        if (!$lastPasien) {
            return date('Ym') . '-001';
        }
        $lastId = $lastPasien->no_rm;
        $lastId = explode('-', $lastId)[1];
        if (!str_starts_with($lastId, date('Ym'))) {
            return date('Ym') . '-001';
        }
        $lastId = (int)$lastId;
        $lastId++;
        $lastId = str_pad($lastId, 3, '0', STR_PAD_LEFT);
        return date('Ym') . '-' . $lastId;
    }

    public static function findByNoRM(string $noRM): ?Pasien
    {
        return self::where('no_rm', $noRM)->firstOrFail();
    }

    public function daftarPoli(): HasMany
    {
        return $this->hasMany(DaftarPoli::class, 'id_pasien');
    }
}
