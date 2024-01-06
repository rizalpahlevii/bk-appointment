<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JadwalPeriksa extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'id_dokter',
        'hari',
        'jam_mulai',
        'jam_selesai',
        'aktif'
    ];

    protected $table = 'jadwal_periksa';

    public function dokter(): BelongsTo
    {
        return $this->belongsTo(Dokter::class, 'id_dokter');
    }

    public function getHariAttribute(): string
    {
        return match ($this->attributes['hari']) {
            'senin' => 'Senin',
            'selasa' => 'Selasa',
            'rabu' => 'Rabu',
            'kamis' => 'Kamis',
            'jumat' => 'Jumat',
            'sabtu' => 'Sabtu',
            'minggu' => 'Minggu',
            default => 'Tidak diketahui'
        };
    }

    /**
     * Check if this schedule is not conflict with another schedule on the same poli
     *
     * @return bool
     */
    public function isNoConflict(): bool
    {
        $poliId = $this->dokter->id_poli;
        $schedule = $this->attributes;
        $schedule['jam_mulai'] = strtotime($schedule['jam_mulai']);
        $schedule['jam_selesai'] = strtotime($schedule['jam_selesai']);
        return !self::where('id_dokter', '!=', $schedule['id_dokter'])
            ->whereHas('dokter', function (Builder $query) use ($poliId) {
                $query->where('id_poli', $poliId);
            })
            ->where('hari', $schedule['hari'])
            ->where(function (Builder $query) use ($schedule) {
                $query->whereBetween('jam_mulai', [$schedule['jam_mulai'], $schedule['jam_selesai']])
                    ->orWhereBetween('jam_selesai', [$schedule['jam_mulai'], $schedule['jam_selesai']]);
            })
            ->doesntExist();
    }

    /**
     * Determine is not available appointment in this day
     *
     * @return bool
     */
    public function canUpdate(): bool
    {
        return DaftarPoli::doesntHave('periksa')
            ->where('id_dokter', $this->attributes['id_dokter'])
            ->whereHas('jadwal', function (Builder $query) {
                $query->whereNotIn('hari', [$this->attributes['hari']]);
            })
            ->exists();

    }

    public function setAktif(): void
    {
        $this->aktif = 'Y';
        $this->save();
    }

    public function setNonaktif(): void
    {
        $this->aktif = 'N';
        $this->save();
    }


}
