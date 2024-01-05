<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use Illuminate\Http\Request;

class JadwalPeriksaController extends Controller
{
    public function index()
    {
        /**
         * @var Dokter $dokter
         */
        $dokter = session('user')->data;
        $dokter->load('jadwal', 'poli');
        return view('pages.jadwal-periksa.index');
    }

    public function update(Request $request)
    {
        /**
         * @var Dokter $dokter
         */
        $dokter = session('user')->data;
        $dokter->load('jadwal', 'poli', 'daftarPoli');
        $poli = $dokter->poli;
        $jadwal = $dokter->jadwal;
        $daftarPoli = $dokter->daftarPoli;

        if (!$jadwal->canUpdate()) {
            return redirect()->route('jadwal-periksa.index')->with('error', 'Jadwal tidak dapat diubah karena sudah ada pasien yang mendaftar di hari tersebut');
        }

        if (!$jadwal->isNoConflict()) {
            return redirect()->route('jadwal-periksa.index')->with('error', 'Jadwal tidak dapat diubah karena bentrok dengan jadwal lain');
        }

    }
}
