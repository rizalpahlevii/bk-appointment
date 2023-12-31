<?php

namespace App\Models;

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
        $lastId = (int)$lastId;
        $lastId++;
        $lastId = str_pad($lastId, 3, '0', STR_PAD_LEFT);
        return date('Ym') . '-' . $lastId;
    }
}
