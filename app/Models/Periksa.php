<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Periksa extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'id_daftar_poli',
        'tgl_periksa',
        'catatan',
        'biaya_periksa',
    ];

    protected $table = 'periksa';

    public function daftarPoli()
    {
        return $this->belongsTo(DaftarPoli::class, 'id_daftar_poli');
    }

    public function detailPeriksa()
    {
        return $this->hasMany(DetailPeriksa::class, 'id_periksa');
    }

    public function obat()
    {
        return $this->belongsToMany(Obat::class, 'detail_periksa', 'id_periksa', 'id_obat');
    }

    public function getTotalBiayaAttribute()
    {
        $biayaObat = $this->detailPeriksa->sum(function ($detailPeriksa) {
            return $detailPeriksa->obat->harga * 1;
        });
        return $biayaObat + $this->biaya_periksa;
    }
}
