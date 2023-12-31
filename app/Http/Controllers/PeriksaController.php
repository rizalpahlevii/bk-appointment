<?php

namespace App\Http\Controllers;

use App\Models\Dokter;

class PeriksaController extends Controller
{
    public function index()
    {
        /**
         * @var Dokter $dokter
         */
        $dokter = session('user')->data;
        $daftarPoli = $dokter->daftarPoli()->with('pasien', 'jadwal', 'periksa')->get();
        return view('pages.periksa.index', compact('daftarPoli'));
    }
}
