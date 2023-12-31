<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use DB;
use Exception;
use Illuminate\Http\Request;

class DaftarController extends Controller
{
    public function index()
    {
        return view('pages.daftar.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => ['required'],
            'alamat' => ['required'],
            'no_hp' => ['required'],
            'no_ktp' => ['required'],
        ]);
        DB::beginTransaction();
        try {
            $pasien = Pasien::create([
                'nama' => $request->nama,
                'alamat' => $request->alamat,
                'no_hp' => $request->no_hp,
                'no_ktp' => $request->no_ktp,
                'no_rm' => Pasien::generateRM(),
            ]);
            DB::commit();
            return redirect()->back()
                ->with(['success' => 'Berhasil mendaftar']);
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->withErrors(['error' => $e->getMessage()]);
        }
    }
}
