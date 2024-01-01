<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use App\Models\Poli;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Throwable;

class DokterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dokter = Dokter::with('poli')->paginate(10);
        return view('pages.dokter.index', compact('dokter'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => ['required', 'string'],
            'no_hp' => ['required', Rule::unique('dokter', 'no_hp')],
            'alamat' => ['required', 'string'],
            'id_poli' => ['required', Rule::exists('poli', 'id')],
            'password' => ['nullable', 'string', 'min:6'],
            'password_konfirmasi' => ['required', 'string', 'same:password']
        ]);
        try {
            $request->merge(['password' => bcrypt($request->input('password'))]);
            $data = $request->except(['password_konfirmasi']);
            Dokter::create($data);
            return redirect()->route('dokter.index')->with('success', 'Data dokter berhasil ditambahkan');
        } catch (Throwable $th) {
            return redirect()->route('dokter.index')->with('error', 'Data dokter gagal ditambahkan');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $poli = Poli::all();
        return view('pages.dokter.create', compact('poli'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $dokter = Dokter::findOrFail($id);
        $poli = Poli::get();
        return view('pages.dokter.edit', compact('dokter', 'poli'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama' => ['required', 'string'],
            'no_hp' => ['required', Rule::unique('dokter', 'no_hp')->ignore($id)],
            'alamat' => ['required', 'string'],
            'id_poli' => ['required', Rule::exists('poli', 'id')],
            'password' => ['nullable', 'string', 'min:6'],
            'password_konfirmasi' => ['nullable', 'string', 'same:password']
        ]);
        try {
            $data = $request->except(['password_konfirmasi']);
            if ($request->filled('password')) {
                $data['password'] = bcrypt($request->input('password'));
            } else {
                unset($data['password']);
            }

            $dokter = Dokter::findOrFail($id);
            $dokter->update($data);
            return redirect()->route('dokter.index')->with('success', 'Data dokter berhasil diubah');
        } catch (Throwable $th) {
            return redirect()->route('dokter.index')->with('error', 'Data dokter gagal diubah');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $dokter = Dokter::findOrFail($id);
            $dokter->delete();
            return redirect()->route('dokter.index')->with('success', 'Data dokter berhasil dihapus');
        } catch (Throwable $th) {
            return redirect()->route('dokter.index')->with('error', 'Data dokter gagal dihapus');
        }
    }
}
