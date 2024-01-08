<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use App\Models\JadwalPeriksa;
use Illuminate\Http\Request;

class JadwalPeriksaController extends Controller
{
    public function index()
    {
        /**
         * @var Dokter $dokter
         */
        $dokter = session('user')->data;
        $jadwal = $dokter->jadwal()->paginate(10);
        return view('pages.jadwal-periksa.index', compact('jadwal'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'hari' => ['required', 'string'],
            'jam_mulai' => ['required'],
            'jam_selesai' => ['required']
        ]);
        /**
         * @var Dokter $dokter
         */
        $dokter = session('user')->data;
        $data = $request->only(['hari', 'jam_mulai', 'jam_selesai']);
        $data['id_dokter'] = $dokter->id;
        $jadwal = JadwalPeriksa::create($data);
        if ($dokter->jadwal()->count() === 1) {
            $jadwal->update(['aktif' => 'Y']);
        }
        return redirect()->route('jadwal-periksa.index')
            ->with('success', 'Jadwal Periksa berhasil ditambahkan');
    }

    public function create()
    {
        return view('pages.jadwal-periksa.create');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'hari' => ['required', 'string'],
            'jam_mulai' => ['required'],
            'jam_selesai' => ['required']
        ]);
        /**
         * @var Dokter $dokter
         */
        $dokter = session('user')->data;
        $data = $request->only(['hari', 'jam_mulai', 'jam_selesai']);
        $data['id_dokter'] = $dokter->id;
        $jadwal = tap(JadwalPeriksa::findOrFail($id)->update($data));
        if ($dokter->jadwal()->count() === 1) {
            $jadwal->update(['aktif' => 'Y']);
        }
        return redirect()->route('jadwal-periksa.index')
            ->with('success', 'Jadwal Periksa berhasil diubah');
    }

    public function edit($id)
    {
        $data = JadwalPeriksa::findOrFail($id);
        return view('pages.jadwal-periksa.edit', compact('data'));
    }

    public function destroy($id)
    {
        JadwalPeriksa::findOrFail($id)->delete();
        return redirect()->route('jadwal-periksa.index')
            ->with('success', 'Jadwal Periksa berhasil dihapus');
    }

    public function switchStatus($id)
    {
        $data = JadwalPeriksa::findOrFail($id);
        if ($data->aktif === 'N') {
            /**
             * @var Dokter $dokter
             */
            $dokter = session('user')->data;
            $dokter->jadwal()->whereNotIn('id', [$data->id])->update([
                'aktif' => 'N'
            ]);
            $data->update(['aktif' => 'Y']);
            return redirect()->route('jadwal-periksa.index')
                ->with('success', 'Jadwal Periksa berhasil diaktifkan');
        }
        $data->update(['aktif' => 'N']);
        return redirect()->route('jadwal-periksa.index')
            ->with('success', 'Jadwal Periksa berhasil dinonaktifkan');
    }
}
