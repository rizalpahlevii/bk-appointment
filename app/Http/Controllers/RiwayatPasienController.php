<?php

namespace App\Http\Controllers;

class RiwayatPasienController extends Controller
{
    public function index()
    {
        return view('pages.riwayat-pasien.index');
    }
}
