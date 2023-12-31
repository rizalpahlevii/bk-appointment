<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use Illuminate\Http\Request;

class ObatController extends Controller
{
    public function index()
    {
        $obat = Obat::paginate(10);
        return view('pages.obat.index', compact('obat'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_obat' => 'required',
            'kemasan' => 'required',
            'harga' => 'required',
        ]);

        $obat = Obat::create([
            'nama_obat' => $request->nama_obat,
            'kemasan' => $request->kemasan,
            'harga' => $request->harga,
        ]);
        return redirect()->route('obat.index')
            ->with('success', 'Obat berhasil ditambahkan');
    }

    public function create()
    {
        return view('pages.obat.create');
    }

    public function edit($id)
    {
        $obat = Obat::findOrFail($id);
        return view('pages.obat.edit', compact('obat'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_obat' => 'required',
            'kemasan' => 'required',
            'harga' => 'required',
        ]);
        $obat = Obat::findOrFail($id);
        $obat->update([
            'nama_obat' => $request->nama_obat,
            'kemasan' => $request->kemasan,
            'harga' => $request->harga,
        ]);
        return redirect()->route('obat.index')
            ->with('success', 'Obat berhasil diupdate');
    }

    public function destroy($id)
    {
        $obat = Obat::findOrFail($id);
        $obat->delete();
        return redirect()->route('obat.index')
            ->with('success', 'Obat berhasil dihapus');
    }
}
