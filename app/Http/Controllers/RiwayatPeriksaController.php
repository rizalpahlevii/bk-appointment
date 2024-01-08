<?php

namespace App\Http\Controllers;

use App\Models\Pasien;

class RiwayatPeriksaController extends Controller
{
    public function index()
    {
        /**
         * @var Pasien $pasien
         */
        $pasien = session('user')->data;
        $riwayat = $pasien->riwayatPeriksa($pasien->id);
        return view('pages.riwayat-periksa.index', compact('riwayat'));
    }
}
