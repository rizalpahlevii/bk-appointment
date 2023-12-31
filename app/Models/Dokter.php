<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dokter extends Model
{
    public $timestamps = false;

    protected $table = 'dokter';

    protected $fillable = [
        'nama', 'alamat', 'no_hp', 'id_poli', 'password'
    ];

    public function poli()
    {
        return $this->belongsTo(Poli::class, 'id_poli');
    }

    public function jadwal()
    {
        return $this->hasMany(JadwalPeriksa::class, 'id_dokter');
    }
}
