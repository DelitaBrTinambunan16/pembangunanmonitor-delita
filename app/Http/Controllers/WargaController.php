<?php

namespace App\Http\Controllers;

use App\Models\Warga;
use Illuminate\Http\Request;

class WargaController extends Controller
{
    /**
     * Tampilkan semua data warga
     */
    public function index()
    {
        $warga = Warga::all();
        return view('Admin.warga.index', compact('warga'));
    }

    /**
     * Form tambah data warga
     */
    public function create()
    {
        return view('Admin.warga.create');
    }

    /**
     * Simpan data warga baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'no_ktp' => 'required|unique:warga',
            'nama' => 'required|string|max:255',
            'jenis_kelamin' => 'required',
            'agama' => 'required|string|max:100',
            'pekerjaan' => 'required|string|max:150',
            'telp' => 'nullable|string|max:20',
            'email' => 'nullable|email',
        ]);

        Warga::create($request->all());
        return redirect()->route('warga.index')->with('success', 'Data warga berhasil ditambahkan!');
    }

    /**
     * Form edit data warga
     */
    public function edit($id)
    {
        $warga = Warga::findOrFail($id);
        return view('Admin.warga.edit', compact('warga'));
    }

    /**
     * Update data warga
     */
    public function update(Request $request, $id)
    {
        $warga = Warga::findOrFail($id);

        $request->validate([
            'no_ktp' => 'required|unique:warga,no_ktp,' . $id . ',warga_id',
            'nama' => 'required|string|max:255',
            'jenis_kelamin' => 'required',
            'agama' => 'required|string|max:100',
            'pekerjaan' => 'required|string|max:150',
            'telp' => 'nullable|string|max:20',
            'email' => 'nullable|email',
        ]);

        $warga->update($request->all());
        return redirect()->route('warga.index')->with('success', 'Data warga berhasil diperbarui!');
    }

    /**
     * Hapus data warga
     */
    public function destroy($id)
    {
        $warga = Warga::findOrFail($id);
        $warga->delete();
        return redirect()->route('warga.index')->with('success', 'Data warga berhasil dihapus!');
    }
}
