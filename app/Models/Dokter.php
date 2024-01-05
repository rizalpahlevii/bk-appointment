<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;

class Dokter extends Model
{
    use HasFactory, HasRelationships;

    public $timestamps = false;

    protected $table = 'dokter';

    protected $fillable = [
        'nama', 'alamat', 'no_hp', 'id_poli', 'password'
    ];

    public function poli(): BelongsTo
    {
        return $this->belongsTo(Poli::class, 'id_poli');
    }

    public function jadwal(): HasOne
    {
        return $this->hasOne(JadwalPeriksa::class, 'id_dokter');
    }

    /**
     * Get all of the periksa for the Dokter
     *
     * @return HasManyThrough
     */
    public function pasien(): HasManyThrough
    {
        return $this->hasManyDeepFromRelations(
            $this->daftarPoli(),
            (new DaftarPoli)->pasien()
        );
    }

    public function daftarPoli(): HasManyThrough
    {
        return $this->hasManyThrough(
            DaftarPoli::class,
            JadwalPeriksa::class,
            'id_dokter',
            'id_jadwal',
            'id',
            'id'
        )->orderBy('daftar_poli.no_antrian', 'asc');
    }
}
