<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use App\Models\Obat;
use App\Models\Periksa;
use DB;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PeriksaController extends Controller
{

    public function index()
    {
        /**
         * @var Dokter $dokter
         */
        $dokter = session('user')->data;
        $daftarPoli = $dokter->daftarPoli()->with('pasien', 'jadwal', 'periksa')->paginate(10);
        return view('pages.periksa.index', compact('daftarPoli'));
    }

    public function show(string $id)
    {
        /**
         * @var Dokter $dokter
         */
        $dokter = session('user')->data;
        $data = $dokter->daftarPoli()->with('pasien', 'jadwal', 'periksa')->findOrFail($id);
        $obat = Obat::all();
        return view('pages.periksa.show', compact('data', 'obat'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_daftar_poli' => ['required', Rule::exists('daftar_poli', 'id')],
            'catatan' => ['nullable', 'string'],
            'obat' => ['nullable', 'array'],
            'tanggal_periksa' => ['required', 'date_format:Y-m-d\TH:i'],
        ]);
        DB::beginTransaction();
        try {
            $periksa = Periksa::create([
                'id_daftar_poli' => $request->input('id_daftar_poli'),
                'catatan' => $request->input('catatan'),
                'tgl_periksa' => $request->input('tanggal_periksa'),
                'biaya_periksa' => 150000
            ]);
            foreach ($request->input('obat') as $obat) {
                $periksa->detailPeriksa()->create([
                    'id_obat' => $obat,
                ]);
            }
            DB::commit();
            return redirect()->route('periksa.index')->with('success', 'Berhasil menambahkan data periksa');
        } catch (Exception $exception) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal menambahkan data periksa');
        }
    }
}
