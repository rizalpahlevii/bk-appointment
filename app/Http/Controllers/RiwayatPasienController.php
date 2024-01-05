<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use App\Models\Pasien;

class RiwayatPasienController extends Controller
{
    public function index()
    {
        /**
         * @var Dokter $dokter
         */
        $dokter = session('user')->data;
        $pasien = $dokter->pasien()->paginate(10);
        return view('pages.riwayat-pasien.index', compact('pasien'));
    }

    public function show($pasienId)
    {
        /**
         * @var Dokter $dokter
         */
        $dokter = session('user')->data;
        $pasien = Pasien::findOrFail($pasienId);
        $riwayat = $pasien->riwayatPeriksaByDokter(session('user')->data->id)->paginate(10);
        return view('pages.riwayat-pasien.show', compact('pasien', 'riwayat', 'dokter'));
    }
}
