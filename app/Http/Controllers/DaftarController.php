<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use DB;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DaftarController extends Controller
{
    public function index()
    {
        return view('pages.daftar.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'alamat' => ['required', 'string', 'max:255'],
            'no_hp' => ['required', Rule::unique('pasien', 'no_hp')],
            'no_ktp' => ['required', Rule::unique('pasien', 'no_ktp')],
            'password' => ['required', 'min:8'],
            'password_konfirmasi' => ['required', 'same:password'],
        ]);

        DB::beginTransaction();
        try {
            Pasien::create([
                'nama' => $request->nama,
                'alamat' => $request->alamat,
                'no_hp' => $request->no_hp,
                'no_ktp' => $request->no_ktp,
                'no_rm' => Pasien::generateRM(),
                'password' => bcrypt($request->password),
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
