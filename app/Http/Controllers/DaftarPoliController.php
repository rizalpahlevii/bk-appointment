<?php

namespace App\Http\Controllers;

use App\Models\DaftarPoli;
use App\Models\Pasien;
use App\Models\Poli;
use DB;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DaftarPoliController extends Controller
{
    public function index()
    {
        $poli = Poli::get();
        return view('pages.daftar-poli.index', compact('poli'));

    }

    public function store(Request $request)
    {
        $request->validate([
            'no_rm' => ['required', Rule::exists('pasien', 'no_rm')],
            'id_poli' => ['required', Rule::exists('poli', 'id')],
            'id_jadwal' => ['required', Rule::exists('jadwal_periksa', 'id')],
            'keluhan' => ['required', 'string', 'max:255'],
        ]);
        DB::beginTransaction();
        try {
            $pasien = Pasien::findByNoRM($request->input('no_rm'));
            DaftarPoli::create([
                'id_pasien' => $pasien?->id,
                'id_jadwal' => $request->input('id_jadwal'),
                'keluhan' => $request->input('keluhan'),
                'no_antrian' => DaftarPoli::generateNoAntrian($request->input('id_jadwal')),
            ]);
            DB::commit();
            return redirect()->back()
                ->with(['success' => 'Berhasil mendaftar']);
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with(['error' => $e->getMessage()]);
        }
    }
}
