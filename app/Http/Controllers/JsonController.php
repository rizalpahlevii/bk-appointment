<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use App\Models\JadwalPeriksa;

class JsonController extends Controller
{
    public function getJadwalByPoliId($poliId)
    {
        $dokter = Dokter::where('id_poli', $poliId)->get();
        return response()->json([
            'status' => 'success',
            'data' => JadwalPeriksa::whereIn('id_dokter', $dokter->pluck('id'))->get()
        ]);
    }
}
