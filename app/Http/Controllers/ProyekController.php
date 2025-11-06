<?php

namespace App\Http\Controllers;

use App\Models\Proyek;
use Illuminate\Http\Request;

class ProyekController extends Controller
{
    public function index()
    {
        $proyek = Proyek::all();
        return view('Admin.proyek.index', compact('proyek'));
    }

    public function create()
    {
        return view('Admin.proyek.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_proyek' => 'required|unique:proyek',
            'nama_proyek' => 'required',
            'tahun' => 'required|digits:4',
            'lokasi' => 'required',
            'anggaran' => 'required|numeric',
            'sumber_dana' => 'required',
            'deskripsi' => 'nullable',
        ]);

        Proyek::create($request->all());
        return redirect()->route('proyek.index')->with('success', 'Data proyek berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $proyek = Proyek::findOrFail($id);
        return view('Admin.proyek.edit', compact('proyek'));
    }

    public function update(Request $request, $id)
    {
        $proyek = Proyek::findOrFail($id);

        $request->validate([
            'kode_proyek' => 'required|unique:proyek,kode_proyek,' . $id . ',proyek_id',
            'nama_proyek' => 'required',
            'tahun' => 'required|digits:4',
            'lokasi' => 'required',
            'anggaran' => 'required|numeric',
            'sumber_dana' => 'required',
            'deskripsi' => 'nullable',
        ]);

        $proyek->update($request->all());
        return redirect()->route('proyek.index')->with('success', 'Data proyek berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $proyek = Proyek::findOrFail($id);
        $proyek->delete();
        return redirect()->route('proyek.index')->with('success', 'Data proyek berhasil dihapus!');
    }
}
